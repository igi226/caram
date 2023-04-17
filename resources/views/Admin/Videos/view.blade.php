@extends('Admin.Master.master')
@section('title', 'Video-view | Caramia')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">Video Information</h4>
            <div class="row mb-3">
               <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b></label>
               <div class="col-sm-10">
                  <h4> {{ $video_details[0]['v_name'] }} </h4>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video</b></label>
               <div class="col-sm-10">
                  @if (isset($video_details[0]['v_video']) &&
                  !empty($video_details[0]['v_video'] && File::exists(public_path('storage/uservideo/' . $video_details[0]['v_video']))))
                  <video class="rounded" width="100%" height="100%" controls>
                  <source src="{{ asset('storage/uservideo/' . $video_details[0]['v_video']) }}"
                     type="video/mp4">
               </div>
               <br>
               @else
               <img height="80" width="100" src="{{ asset('noimg.png') }}"
                  alt="no-image"><br><br>
               @endif
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video Uploaded by</b>
               </label>
               <div class="col-sm-10">
                  <p><b> {{ $video_details[0]['videoOwner']['name'] }}</b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Contest Name</b>
               </label>
               <div class="col-sm-10">
                  <p><b> {{ $video_details[0]['videoContest']['contest_name'] }}</b></p>
               </div>
            </div>
            
            <a href="{{ url('admin/videos') }}" class="btn btn-primary" type="submit">Cancel</a>
         </div>
      </div>
   </div>
</div>
@endsection