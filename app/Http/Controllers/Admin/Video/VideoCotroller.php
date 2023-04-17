<?php

namespace App\Http\Controllers\Admin\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateReq;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VideoCotroller extends Controller
{
    public function videos(Request $request)
    {
        $data['contests'] = DB::table('contests')->where('contest_status', 1)->get();

        if (request()->segment(3) !== null) {
            $data['videos'] = Video::where('contest_id', request()->segment(3))->join('users', 'videos.user_id', '=', 'users.id')->join('contests', 'videos.contest_id', '=', 'contests.id')->select('videos.id', 'videos.v_name', 'videos.v_slug', 'videos.v_video', 'videos.v_status', 'videos.is_winner', 'users.name', 'contests.contest_name')->orderBy("videos.id", "DESC")->get();
        } else {
            $data['videos'] = Video::join('users', 'videos.user_id', '=', 'users.id')->join('contests', 'videos.contest_id', '=', 'contests.id')->select('videos.id', 'videos.v_name', 'videos.v_slug', 'videos.v_video', 'videos.v_status', 'videos.is_winner', 'users.name', 'contests.contest_name')->orderBy("videos.id", "DESC")->get();
        }
        return view('Admin.Videos.show', $data);
    }

    public function create()
    {
        $data['all_users'] = DB::table('users')->where('role', 'user')->get();
        $data['contests'] = DB::table('contests')->where('contest_status', '1')->get();

        return view('Admin.Videos.create', $data);
    }

    public function store(ValidateReq $req)
    {
        $data = $req->except('_token', 'v_video', 'v_slug', "files");
        if ($req->has("v_video")) {

            $video = $req->file("v_video");

            $user_video =
                time() .
                rand(0000, 9999) .
                "." .
                $video->getClientOriginalExtension();

            $video->storeAs("public/uservideo", $user_video);

            $data["v_video"] = $user_video;
        }

        $slug = Str::slug($data['v_name']);
        $slug_count = DB::table('videos')->where('v_slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = random_int(100000, 999999) . '-' . $slug;
        }
        $data['v_slug'] = $slug;
        //dd($data);

        $store = DB::table('videos')->insert($data);
        if ($store) {
            return redirect('/admin/videos')->with("msg", $data['v_name'] . " Added Successfully");
        } else {
            return redirect()->back()->with('msg', 'some error occur!');
        }
    }


    public function changeS(Request $request)
    {
        // dd('dtyhr');

        $status = DB::table('videos')->where('v_slug', $request->v_slug)->update(['v_status' => $request->v_status]);
        if ($status) {
            return response()->json([
                'status' => 1,
                'msg' => 'Status Successfully Updated'
            ]);
        }
    }

    public function changeWS(Request $request)
    {
        // dd('dtyhr');
        $video = DB::table('videos')->where('v_slug', $request->v_slug)->first();
        //   $contest = DB::table('contests')->where('id', $video->contest_id)->first();
        $winner_table = DB::table('winner')->where('contest_id', $video->contest_id)->count();
        if ($winner_table > 0) {
            $update_winner = DB::table('winner')->where('contest_id', $video->contest_id)->update([
                'video_id' => $video->id,
                'user_id' => $video->user_id,
            ]);
            $old_winner = DB::table('videos')->where('contest_id', $video->contest_id)->where('is_winner', 1)->update([
                'is_winner' => 0
            ]);
            // $old_winner
            $status = DB::table('videos')->where('v_slug', $request->v_slug)->update(['is_winner' => $request->is_winner]);
            if ($status && $update_winner) {
                return response()->json([
                    'status' => 1,
                    'msg' => 'This Contest Already had a Winner of the same rank; it is replaced successfully'
                ]);
            }

        } else {
            $update_winner = DB::table('winner')->insert([
                'contest_id' => $video->contest_id,
                'video_id' => $video->id,
                'user_id' => $video->user_id,
            ]);
            $status = DB::table('videos')->where('v_slug', $request->v_slug)->update(['is_winner' => $request->is_winner]);
            if ($status) {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Winner is Created Successfully!'
                ]);
            }
        }

    }



    public function edit($v_slug)
    {
        $data['particular_video'] = Db::table('videos')
            ->where('v_slug', $v_slug)
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->join('contests', 'videos.contest_id', '=', 'contests.id')
            ->select('contests.contest_name', 'videos.v_slug', 'videos.user_id', 'videos.contest_id', 'videos.v_name', 'videos.v_description', 'videos.v_video', 'videos.v_tag', 'videos.v_status', 'users.name')
            ->first();

        $data['all_users'] = DB::table('users')->whereNotIn('id', [$data['particular_video']->user_id])->get();
        $data['all_contests'] = DB::table('contests')->whereNotIn('id', [$data['particular_video']->contest_id])->get();
        // dd($data);
        return view('Admin.Videos.edit', $data);

    }

    public function update(ValidateReq $req, $v_slug)
    {
        $old_video = DB::table('videos')->where("v_slug", $v_slug)->first();
        $data = $req->except('_token', 'v_video');
        if ($req->has("v_video")) {
            if (file_exists("storage/app/public/uservideo/" . $old_video->v_video)) {
                unlink("storage/app/public/uservideo/" . $old_video->v_video);
            }
            $video = $req->file("v_video");

            $user_video =
                time() .
                rand(0000, 9999) .
                "." .
                $video->getClientOriginalExtension();

            $video->storeAs("public/uservideo", $user_video);

            $data["v_video"] = $user_video;
        } else {
            $data["v_video"] = $old_video->v_video;
        }
        // dd($data);
        $update = Video::where('v_slug', $v_slug)->update($data);
        if ($update) {
            return redirect('admin/videos')->with('msg', $old_video->v_name . ' Updated as Successfully');
        }
    }


    public function view($slug)
    {
        $data['video_details'] = Video::where('v_slug', $slug)->with('videoOwner', 'videoContest')->get();
        // dd($data);
        return view('Admin.Videos.view', $data);
    }



    public function deletevideo($slug)
    {

        $delete_video = Video::where('v_slug', $slug)->first();

        //File::delete("storage/uservideo/" . $delete_video->v_video);
        if (file_exists("storage/app/public/uservideo/" . $delete_video->v_video)) {
            unlink("storage/app/public/uservideo/" . $delete_video->v_video);
        }

        $delete_video->delete();
        return redirect()->back()->with('msg', $delete_video->v_name . ' Deleted Successfully');
    }

    //modal video
    public function show_video($id)
    {
        return Video::findOrFail($id);

    }

}