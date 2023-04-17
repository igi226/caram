<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cms'] = DB::table("cms")->get();
        return view("Admin.Cms.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Cms.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string"
        ]);
        $data = $request->except('_token', 'image', 'video');
        $slug = Str::slug($data['title']);
       $slug_count = DB::table('cms')->where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().rand(100000, 999999).'-'.$slug;
        } 
       $data['slug'] = $slug;
       if ($request->has("image")) {
            
            $image = $request->file("image");
            
            $cms_img =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
        
            $image->storeAs("public/CmsImage", $cms_img);
           
        
            $data["image"] = $cms_img;
        }
        if ($request->has("video")) {

            $video = $request->file("video");

            $user_video =
                time() .
                rand(0000, 9999) .
                "." .
                $video->getClientOriginalExtension();

            $video->storeAs("public/CmsImage", $user_video);

            $data["video"] = $user_video;
        }
        $store = DB::table('cms')->insert($data);
        if($store){
            return redirect('/admin/cms')->with("msg", " Added Successfully");
        }else{
            return redirect()->back()->with('msg', 'some error occur!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['cms'] = DB::table('cms')->where('slug', $slug)->first();
        return view("Admin.Cms.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data['cms'] = DB::table('cms')->where('slug', $slug)->first();
        return view("Admin.Cms.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            "title" => "required|string"
        ]);
        $data = $request->except('_method', '_token', 'image', 'video');
        $img = DB::table('cms')->where("slug", $slug)->select('image', 'video')->first();
 
        
         if ($request->has("image")) {
             if(!empty($img->image) && file_exists(public_path("CmsImage/" . $img->image))){
                 unlink(public_path("CmsImage/" . $img->image));
                 }
             
             
             $image = $request->file("image");
             
             $cms_img =
                 time() .
                 rand(0000, 9999) .
                 "." .
                 $image->getClientOriginalExtension();
         
            
             $image->storeAs("public/CmsImage", $cms_img);
 
         
             $data["image"] = $cms_img;
         }else {
             $data["image"] = $img->image;
         }
         if ($request->has("video")) {
            if (file_exists("storage/app/public/CmsImage/" . $img->video)) {
                unlink("storage/app/public/CmsImage/" . $img->video);
            }
            $video = $request->file("video");

            $user_video =
                time() .
                rand(0000, 9999) .
                "." .
                $video->getClientOriginalExtension();

            $video->storeAs("public/CmsImage", $user_video);

            $data["video"] = $user_video;
        } else {
            $data["video"] = $img->video;
        }
         $update = DB::table('cms')->where('slug', $slug)->update($data);
 
         if($update){
             return redirect('/admin/cms')->with("msg", " Information Updated Successfully");
         }else{
             return redirect()->back()->with('msg', 'some error occur!');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
