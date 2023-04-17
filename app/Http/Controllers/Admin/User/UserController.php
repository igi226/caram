<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateReq\ValidateReq;
use App\Http\Requests\ValidateReq as RequestsValidateReq;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function userInformation($slug){
       
        $data['particular_user'] = User::where('slug',$slug)->with('userVideos')->first();
       //dd($data);
       // $data['user_product'] = $data['particular_user']->products()->get();
        
        return view('Admin.User.view', $data);

     
    }


    public function show(){
        $data['users_all'] = DB::table('users')->where('role','user')->get();
        return view('Admin.User.show', $data);
    }

    public function create(){
        return view('Admin.User.create');
    }

    public function store(RequestsValidateReq $req){
        $data = $req->except('_token', 'image','slug','password');
// dd($data);
        if ($req->has("image")) {
            
            $image = $req->file("image");
            
            $user_image =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
        
            $image->storeAs("public/UserImage", $user_image);
         
            $data["image"] = $user_image;
        }
       
        $slug = Str::slug($data['name']);
        $slug_count = DB::table('users')->where('slug',$slug)->count();
        if($slug_count>0){
            $slug = random_int(100000, 999999).'-'.$slug;
        }
        $data['slug'] = $slug;
        $data['password'] = Hash::make($req->password);
        $store = DB::table('users')->insert($data);
        if($store){
            return redirect('/admin/users')->with("msg", $data['name']."Added Successfully");
        }else{
            return redirect()->back()->with('msg', 'some error occur!');
        }
    }

    public function edit($slug){
        $data['particular_user'] = DB::table('users')->where('slug',$slug)->first();
        return view('Admin.User.edit', $data);
    }

    public function update($slug, RequestsValidateReq $req){
        // dd("hh");
        $data = $req->except('_token', 'image');

        if ($req->has("image")) {
            $img = DB::table('users')->where("slug", $slug)->first();
           
            if(file_exists("storage/app/public/UserImage/".$img->image)){
            //     unlink("storage/app/public/UserImage/".$img->image);
            File::delete(public_path("storage/UserImage/" . $img->image));
            }
           
            $image = $req->file("image");
            

            $user_image =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
            
            $image->storeAs("public/UserImage", $user_image);
       
            $data["image"] = $user_image;
        }else {
            
            $img = DB::table('users')->where("slug", $slug)->first();
            // dd($img->image);
            $data["image"] = $img->image;
        }

        
        // dd($data);
        $update = User::where('slug',$slug)->update($data);
        //dd($update);
        if ($update) {
            return redirect('admin/users')
                ->with("msg", "User Information Updated Successfully");
        } else {
            return redirect()
                ->back()
                ->with("msg", "Some Error Occured!");
        }

    }


    public function changeS(Request $request)
    {
      
      $status = DB::table('users')->where('slug',$request->slug)->update(['status'=>$request->status]);
        if($status){
            return response()->json([
                'status' => 1,
                'msg' => 'Status Successfully Updated'
            ]);
        }
    }

 
    

    public function deleteUser($slug){

        $delete_user = User::where('slug',$slug)->first();
        $videos =  $delete_user->userVideos()->where('user_id', $delete_user->id)->get();
       
       foreach ($videos as $vid) {
        //dd($vid);
        if(file_exists("storage/app/public/uservideo/".$vid->v_video)){
            unlink("storage/app/public/uservideo/".$vid->v_video);
        }
        $vid->delete();
       }
        // File::delete("storage/UserImage/" . $delete_user->image);
        if(file_exists("storage/app/public/UserImage/".$delete_user->image)){
            unlink("storage/app/public/UserImage/".$delete_user->image);
        }
        $delete_user->delete();
       
         
      
        
        return redirect()->back()->with('msg',$delete_user->name .' Deleted Successfully');
    }


    
 
}
