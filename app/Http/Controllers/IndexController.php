<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Contests;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index() {
        $data['contests'] = Contests::where('end_dt', '>=', now())->get();
        $data['contests_latest'] = Contests::orderBy('id', 'desc')->take(3)->get();
        $data['home1'] = DB::table("cms")->where("slug", "28cvzhesfs")->first(); 
        $data['home2'] = DB::table("cms")->where("slug", "video")->first(); 
        $data['home3'] = DB::table("cms")->where("slug", "tango-teacher-video-contest")->first(); 
        $data['home4'] = DB::table("cms")->where("slug", "record-your-dance")->first(); 
        $data['home5'] = DB::table("cms")->where("slug", "send-it-to-us")->first(); 
        $data['home6'] = DB::table("cms")->where("slug", "wait-for-our-results")->first(); 
        return view('User.Index.index', $data);
    }

    public function registerForVideo ($contest_id) {
        // dd($contest_id);

        $contests = Contests::where('id', $contest_id)->first();
        if(!$contests){
            return redirect()->route("index");
        }else{
            $data['contests'] = Contests::where('id', $contest_id)->select("contest_name", "id")->first();
            return view('User.Video.registerVideo', $data);
        }

       
    }

    public function userUploadVideo( Request $request) {
        // $data = $request->all();

        //   dd($data);
        $request->validate([
            "title" => "required|string",
            "family_name" => "required|string",
            "name" => "required|string",
            "email" => "required|email",
            // "password" => "required|min:8",
            "dob" => "required",
            "termsAccept" => "required",
        ]);
        // $data = $request->except("_token");
        $slug = Str::slug($request->name);
        $slug_count = DB::table('users')->where('slug',$slug)->count();
        if($slug_count>0){
            $slug = random_int(100000, 999999).'-'.$slug;
        }
        if ($request->has("image")) {
            
            $image = $request->file("image");
            
            $user_image =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
        
            $image->storeAs("public/UserImage", $user_image);
         
            // $data["image"] = $user_image;
        }else{
            $user_image = null;
        }

        $register['register'] = User::create([
            "title" => $request->title,
            "name" => $request->name,
            "family_name" => $request->family_name,
            "email" => $request->email,
            // "password" => Hash::make($request->password),
            "dob" =>  date("Y-m-d", strtotime($request->dob)),
            "termsAccept" => $request->termsAccept,
            "slug" => $slug,
            "image" => $user_image

        ]);
        $contest_id['contest_id']= $request->contest_id;
        //  return $register;
        return $this->uploadVideo($register, $contest_id);

    }

    public function uploadVideo($register, $contest_id) {
        return view("User.Video.uploadVideo", $register, $contest_id);
    }

    public function uploadVideopost( Request $request ) {
        $request->validate([
            "v_video" => "required"
        ]);
        $data = $request->except("_token");
        $slug = Str::slug($request->file("v_video"));
        $slug_count = DB::table('videos')->where('v_slug',$slug)->count();
        if($slug_count>0){
            $slug = random_int(100000, 999999).'-'.$slug;
        }
        $data['v_slug'] = $slug;
        if ($request->has("v_video")) {
            $video = $request->file("v_video");
            $v_video =
                time() .
                rand(0000, 9999) .
                "." .
                $video->getClientOriginalExtension();
            $video->storeAs("public/uservideo", $v_video);
            $data["v_video"] = $v_video;
        }
        // dd($data);
        Video::create($data);
        return view('User.Video.successUpload');
    }

    public function getWinners() {
        $data["winners"] = DB::table("winner")
            ->join("users", "winner.user_id", "=", "users.id")
            ->join("videos", "winner.video_id", "=", "videos.id")
            ->join("contests", "winner.contest_id", "=", "contests.id")
            ->select("contests.contest_name", "videos.v_name", "videos.v_voting", "users.name", "users.image", "winner.voting", "winner.contest_id")
            ->orderby('videos.v_voting', 'asc')
            ->get();
        // return $data;
        return view("User.Winner.winner", $data);
    }

    public function aboutUs() {
        return view("User.Aboutus.aboutUs");
    }

    public function contactUs() {
        return view("User.Contactus.contactUs");
    }

    public function contactForm( Request $request ) {
        $request->validate([
            "name" => "required|string",  
            "email" => "required|email", 
            "message" => "required|string|max:200", 
        ]);
        $data = $request->except("_token");
        ContactUs::create($data);
        return back()->with("msg", "Thanks for your time");
    }

    public function sitePolicy() {
        return DB::table("site_policies")->where("slug", "site-policy")->first();
    }

    public function terms() {
        $data['terms'] = $this->sitePolicy()->terms;
        // dd($data['terms']);
        return view("User.terms", $data);
    }

    
    public function privacyPolicy() {
        $data['privacyPolicy'] = $this->sitePolicy()->privacy;
        // dd($data['terms']);
        return view("User.privacyPolicy", $data);
    }
}
