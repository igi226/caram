<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateReq;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view('Admin.Auth.login');
    }

    public function login(Request $request)
    {
      
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user =  DB::table('users')->where('email',$request->email)->where('role','admin')->first();
        
        if(!$user || !Hash::check($request->password,$user->password)){
            return redirect()->back()->with('msg','Cradentials are wrong! Provide correct information');
        } else{
          
           Session::put('adminLogin',[ $user->id, $user->role, $user->name, $user->image ]);

           return redirect('admin/dashboard');

         }   
       // if($user && )
    }

    public function logOut(){
        Session::forget('adminLogin');
        return redirect('admin');
    }

    public function dashboard()
    {
        $data['users'] = DB::table('users')->where('role','user')->count();
        $data['contests'] = DB::table('contests')->count();
        $data['videos'] = DB::table('videos')->count();
        $data['latest_videos'] = Video::with("videoOwner","videoContest")->latest()->take(5)->get();
        // $data['latest_videos'] = Video::videoOwner()->videoContest()->latest()->take(5)->get();
    //   dd($data);
        $data['latest_winner'] = DB::table('winner')->leftJoin('users', 'winner.user_id', '=', 'users.id')->leftJoin('contests', 'winner.contest_id', '=', 'contests.id')->leftJoin('videos', 'winner.video_id', '=', 'videos.id')->latest('winner.created_at')->select('contests.contest_name', 'users.name', 'videos.v_slug')->first();
        //   dd($data);
        return view('Admin.Dashboard.dashboard', $data);
    }

    public function profile(){
        $data['admin_profile'] = DB::table('users')->where('role','admin')->first();
        // dd($data);
        return view('Admin.Profile.profile', $data);
    }

    public function updateProfile(ValidateReq $req){
        $data = $req->except('_token','image');
        $old_img = DB::table('users')->where('role','admin')->select('image')->first();
        // dd($old_img->image);
        if($req->has('image')){
            // dd('hh');
           
            // File::delete("storage/UserImage/" . $old_img->image);
            if(file_exists("storage/app/public/UserImage/".$old_img->image)){
            unlink("storage/app/public/UserImage/".$old_img->image);
            }
            $image = $req->file("image");
            

            $admin_image =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
            
            $image->storeAs("public/UserImage", $admin_image);
       
            $data["image"] = $admin_image;
        }else {
        
            $data['image'] = !empty($old_img->image) ? $old_img->image : null;
            // dd($data['image']);
        }
// dd($data);
        $update = User::where('role','admin')->update($data);
        //dd($update);
        if ($update) {
            return redirect()
                ->back()
                ->with("msg", "Your Information Updated Successfully");
        } else {
            return redirect()
                ->back()
                ->with("msg", "Some Error Occured!");
        }

    }

    public function password(){
        return view('Admin.Profile.changePassword');
    }

    public function updatePassword( ValidateReq $req ) {
        
        $old_password = DB::table('users')->where('role','admin')->select('password')->first();
        if (Hash::check($req->current_password, $old_password->password)) {
            $update_password = DB::table('users')->where('role','admin')->update(['password' => Hash::make($req->new_password)]);
            if ($update_password) {
                return redirect()->back()->with('msg', 'Password updated successfully');
            } else {
                return redirect()->back()->with('msgEr', 'Password updation failed');
            }
        }else{
            return redirect()->back()->with("msgEr", "Current Password doesn't Match with Old Password");
        }
    }
}
