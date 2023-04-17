<?php

namespace App\Http\Controllers\Admin\Contests;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateReq;
use App\Models\Contests;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;




class ContestController extends Controller
{
    public function contests()
    {
        $data["contests"] = DB::table("contests")->get();

        return view("Admin.Contests.show", $data);
    }

    public function create()
    {
        return view("Admin.Contests.create");
    }

    public function store(ValidateReq $req)
    {
        // dd("valif");
        $data = $req->except("_token", "slug", "files");
        $slug = Str::slug($data["contest_name"]);
        $slug_count = DB::table("contests")
            ->where("slug", $slug)
            ->count();
        if ($slug_count > 0) {
            $slug = time() . "-" . $slug;
        }
        $data["slug"] = $slug;
        $store = DB::table("contests")->insert($data);
        if ($store) {
            return redirect("admin/contests")->with(
                "msg",
                $data["contest_name"] . " Created Successfully"
            );
        } else {
            return redirect()
                ->back()
                ->with("msg", "Some error Occur!");
        }
    }

    public function edit($slug)
    {
        $data["particular_contest"] = DB::table("contests")
            ->where("slug", $slug)
            ->first();
        return view("Admin.Contests.edit", $data);
    }

    public function update(ValidateReq $req, $slug)
    {
        $data = $req->except("_token","files");
        // dd($data);
        $update = Contests::where("slug", $slug)->update($data);
        if ($update) {
            return redirect("admin/contests")->with(
                "msg",
                $data["contest_name"] . " Updated Successfully"
            );
        } else {
            return redirect()
                ->back()
                ->with("msg", "Some error Occur!");
        }
    }

    public function changeS(Request $request)
    {
        $status = Contests::where("slug", $request->slug)->update([
            "contest_status" => $request->contest_status,
        ]);
        if ($status) {
            return response()->json([
                "status" => 1,
                "msg" => "Status Successfully Updated",
            ]);
        }
    }

    public function deletecontest($slug)
    {
        $deletecontest = Contests::where("slug", $slug)->first();
        $videos = $deletecontest
            ->contestVideos()
            ->where("contest_id", $deletecontest->id)
            ->get();

        foreach ($videos as $vid) {
            if (file_exists("storage/app/public/uservideo/" . $vid->v_video)) {
                unlink("storage/app/public/uservideo/" . $vid->v_video);
            }
            $vid->delete();
        }
        $deletecontest->delete();
        return redirect()
            ->back()
            ->with(
                "msg",
                $deletecontest->contest_name .
                    " Deleted Successfully with its all video"
            );
    }

    public function view($slug)
    {
        $data["contest"] = Contests::where("slug", $slug)
            ->with("contestVideos")
            ->first();
        $data["videos"] = Video::where(
            "contest_id",
            $data["contest"]->id
        )->count();
        // dd($data['contest']->contestVideos[0]->v_name);
        return view("Admin.Contests.view", $data);
    }

    public function winners()
    {
        $data["winners"] = DB::table("winner")
            ->join("users", "winner.user_id", "=", "users.id")
            ->join("videos", "winner.video_id", "=", "videos.id")
            ->join("contests", "winner.contest_id", "=", "contests.id")
            ->select("contests.contest_name", "videos.v_name", "users.name", "winner.voting")
            ->get();
            // dd($data);
        return view("Admin.Winner.show", $data);
    }

    public function createWinner()
    {
        $data["contests"] = DB::table("contests")
            ->where("contest_status", 1)
            ->get();
        return view("Admin.Winner.create", $data);
    }

    public function getVideos(Request $request)
    {
        
        $data = DB::table('videos')->where('videos.contest_id', $request->contest_id)->where('videos.v_status', 1)
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->join('contests', 'videos.contest_id', '=', 'contests.id')
            ->select('videos.id', 'videos.v_voting', 'videos.contest_id', 'videos.user_id', 'videos.v_slug', 'videos.v_name', 'videos.v_video', 'users.name', 'contests.contest_name',)
            ->get();
       
        if (!empty($data[0]->v_video) && File::exists(public_path('storage/uservideo/' . $data[0]->v_video)))
           {
             
            $html = "";   
            foreach ($data as $video) {
                $html .= '<tr id="'.$video->id.'">
                <td id="'.$video->contest_id.'">
                   <b>'.$video->v_name.'</b>
                </td>
                <td width="100">
                   <div class="video-layer">
                      <video controls>
                         <source src="'. url("storage/uservideo/" .$video->v_video).'"
                         type="video/mp4">
                      </video>
                      <button class="videoplaybtn" onclick="playVideo('.$video->id.')" data-bs-toggle="modal"
                         data-bs-target="#exampleModal" data-id="'.$video->id.'"><i
                         class="fa fa-play"></i></button>
                   </div>
                </td>
                <td>'.$video->name.'</td>
                <td>'.$video->contest_name.'</td>
                <td>
                   <select id="winnerVideo" onchange="myFunction(this.value,'.$video->id.', '.$video->contest_id.', '.$video->user_id.')">
                      <option value="'.$video->v_voting.'">'.$video->v_voting.' </option>
                      <option value="">0 </option>
                      <option value="1">1 </option>
                      <option value="2">2</option>
                      <option value="3">3 </option>
                      <option value="4">4 </option>
                      <option value="5">5 </option>
                      <option value="6">6 </option>
                      <option value="7">7 </option>
                      <option value="8">8 </option>
                      <option value="9">9 </option>
                      <option value="10">10 </option>
                   </select>
                </td>
             </tr>';
            
            }
            }else{
            $html =  'No Videos for this contest';
           }

          
            print_r($html);


    }

    public function getUser(Request $request)
    {
        $vid = $request->post("videoId");
        $video = DB::table("videos")
            ->where("id", $vid)
            ->first();
        $user = DB::table("users")
            ->where("id", $video->user_id)
            ->first();
        $html =
            '<img src="' .
            asset("storage/UserImage/" . $user->image) .
            '" alt="no" height="80" width="100" class="border-img">
        <input type="hidden" name="user_id" value="' .
            $user->id .
            '">
        <div class="align-name">
            <label for="">Name:</label>
            <span>' .
            $user->name .
            '</span>      
        </div>
        <div class="align-name">
        <label for="">Phone:</label>
        <span>' .
            $user->phone .
            '</span>         
        </div>
       ';
        echo $html;
    }

    public function uploadWinner(Request $request)
    {
 
        $data = $request->except("_token");
       
        $check_if_exist = DB::table('videos')->where('contest_id', $data['contest_id'])->where('v_voting', $data['v_voting'])->first();
        $check_if_winner = DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->first();
        if(!$check_if_exist && !$check_if_winner){
            $store = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);
            $winner_check = DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->first();
            if($winner_check && !$data['v_voting'] == null){
                DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->update(['voting' => $data['v_voting']]);
            }else{
            $winner = DB::table("winner")->insert(['contest_id' => $data['contest_id'], 'video_id' => $data['video_id'],  'voting' => $data['v_voting'], 'user_id' => $data['user_id']]);
            }
            return response()->json([
                "status" => 1,    
            "msg" =>"Winner Created Successfully",
                ]);
        }else{
           if( $data['v_voting'] == null){
            $newVideoWinner = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);
            $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->delete();
            return response()->json([
                "status" => 1,    
                "msg" => "Rating is Updated and Video is deleted from Winner list",
                ]);
            }
           else{
            $oldNull = DB::table('videos')->where('contest_id', $data['contest_id'])->where('v_voting', $data['v_voting'])->update(['v_voting' => ""]);
            $newVideoWinner = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);

            $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->first();
            if($oldWinnerNull){
                    $oldWinnerNull = DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->delete();
                    $oldVideoWinner = DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->first();
                    if($oldVideoWinner){
                        $oldUpdate = DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->update(["voting" => $data['v_voting']]);
                    }else{
                        $newWinner = DB::table('winner')->insert([
                            "user_id" => $data["user_id"],
                            "video_id" => $data["video_id"],
                            "contest_id" => $data["contest_id"],
                            "voting" => $data["v_voting"],
                        ]);
                }

            }else{
                    $newWinner = DB::table('winner')->insert([
                        "user_id" => $data["user_id"],
                        "video_id" => $data["video_id"],
                        "contest_id" => $data["contest_id"],
                        "voting" => $data["v_voting"],
                    ]);
            }
            $data = DB::table('videos')->where('videos.contest_id', $data["contest_id"])->where('videos.v_status', 1)
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->join('contests', 'videos.contest_id', '=', 'contests.id')
            ->select('videos.id', 'videos.v_voting', 'videos.contest_id', 'videos.user_id', 'videos.v_slug', 'videos.v_name', 'videos.v_video', 'users.name', 'contests.contest_name',)
            ->get();
       
        if (!empty($data[0]->v_video) && File::exists(public_path('storage/uservideo/' . $data[0]->v_video)))
           {
             
            $html = "";   
            foreach ($data as $video) {
                $html .= '<tr id="'.$video->id.'">
                <td id="'.$video->contest_id.'">
                   <b>'.$video->v_name.'</b>
                </td>
                <td width="100">
                   <div class="video-layer">
                      <video controls>
                         <source src="'. url("storage/uservideo/" .$video->v_video).'"
                         type="video/mp4">
                      </video>
                      <button class="videoplaybtn" onclick="playVideo('.$video->id.')" data-bs-toggle="modal"
                         data-bs-target="#exampleModal" data-id="'.$video->id.'"><i
                         class="fa fa-play"></i></button>
                   </div>
                </td>
                <td>'.$video->name.'</td>
                <td>'.$video->contest_name.'</td>
                <td>
                   <select id="winnerVideo" onchange="myFunction(this.value,'.$video->id.', '.$video->contest_id.', '.$video->user_id.')">
                      <option value="'.$video->v_voting.'">'.$video->v_voting.' </option>
                      <option value="">0 </option>
                      <option value="1">1 </option>
                      <option value="2">2</option>
                      <option value="3">3 </option>
                      <option value="4">4 </option>
                      <option value="5">5 </option>
                      <option value="6">6 </option>
                      <option value="7">7 </option>
                      <option value="8">8 </option>
                      <option value="9">9 </option>
                      <option value="10">10 </option>
                   </select>
                </td>
             </tr>';
            
            }
            }else{
            $html =  'No Videos for this contest';
           }

          
            
            return response()->json([
                    "status" => 1,  
                    "list"  => $html,
                    "msg" => "This Contest Already had a Winner of the same rank; it is replaced successfully",
                    ]);
            }
        }
        
     
    }
}


//  <td><?php 
// if($item->is_winner == 0){
                               
//     echo '<label class="switch">
 
//      <input class="changeWS" type="checkbox" data-id="'.$item->v_slug.'">
 
//      <span class="slider round"></span>
 
//      </label>';
//  }elseif($item->is_winner == 1){
//      echo "<span class='badge rounded-pill badge-soft-success font-size-12'>Winner</span>";
//  }
//   

// public function uploadWinner(Request $request)
// {
 
//     $data = $request->except("_token");
//     //dd($data);
//     $check_if_exist = DB::table('videos')->where('contest_id', $data['contest_id'])->where('v_voting', $data['v_voting'])->first();
//     $check_if_winner = DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->first();
//     //
//     if(!$check_if_exist && !$check_if_winner){
//         //dd('not0');
//         $store = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);
//         $winner_check = DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->first();
//         if($winner_check && !$data['v_voting'] == null){
//             DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->update(['voting' => $data['v_voting']]);
//         }else{
//         $winner = DB::table("winner")->insert(['contest_id' => $data['contest_id'], 'video_id' => $data['video_id'],  'voting' => $data['v_voting'], 'user_id' => $data['user_id']]);
//         }
//         return response()->json([
//             "status" => 1,    
//         "msg" =>"Winner Created Successfully",
//             ]);
//     }else{
//        if( $data['v_voting'] == null){
//         $newVideoWinner = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);
//         $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'])->delete();
//         return response()->json([
//             "status" => 1,    
//         "msg" => "Rating is Updated and Video is deleted from Winner list",
//             ]);
//         }
//        else{
//         $oldNull = DB::table('videos')->where('contest_id', $data['contest_id'])->where('v_voting', $data['v_voting'])->update(['v_voting' => null]);
//         $newVideoWinner = DB::table('videos')->where('id', $data['video_id'])->update(['v_voting' => $data['v_voting']]);
//         // $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->update(['voting' => $data['v_voting'], 'video_id' => $data['video_id'], 'user_id' => $data['user_id']]);
//             $oldVoting = DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->first();
//             if($oldVoting){
//                 $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('voting', $data['v_voting'])->delete();
//                 $newWinner =  DB::table('winner')->insert([
//                    'contest_id', $data['contest_id'],
//                    'voting', $data['v_voting'],
//                    'user_id', $data['user_id']
//                 ]);
//             }
       
//         // $oldWinnerNull =  DB::table('winner')->where('contest_id', $data['contest_id'])->where('video_id', $data['video_id'],)->update(['voting' => $data['v_voting']]);
//         // $check_if_winner ->;
//         return response()->json([
//                 "status" => 1,    
//             "msg" => "This Contest Already had a Winner of the same rank; it is replaced successfully",
//                 ]);
//         }
//     }
    
 
// }
