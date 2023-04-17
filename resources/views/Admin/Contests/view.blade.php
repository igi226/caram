
@extends('Admin.Master.master')
@section('title', 'Contest-view | Caramia')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">Contest Information</h4>
            <div class="row mb-3">
               <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b></label>
               <div class="col-sm-10">
                  <h4> {{ $contest->contest_name }} </h4>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Contest
               Description</b></label>
               <div class="col-sm-10">
                  <p><b><?php echo html_entity_decode($contest->contest_description );?></b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Total Videos ({{ $videos }})</b></label>
               
               @if (!empty($contest->contestVideos[0]->v_video) && File::exists(public_path('storage/uservideo/' . $contest->contestVideos[0]->v_video)))
             
             
               
               @foreach($contest->contestVideos as $video)
               <div class="col-sm-3 col-md-2">
                  <video height="100" width="100%"  controls>
                  <source src="{{ asset('storage/uservideo/' . $video->v_video) }}" type="video/mp4">
                  </video>
                </div>
               @endforeach
              
             
               <br>
               @else
               <div class="col-sm-3">
               <img height="80" width="100" src="{{ asset('noimg.png') }}"
                  alt="no-image"><br><br>
                </div>  
               @endif
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Contest Start date</b>
               </label>
               <div class="col-sm-10">
                  <p><b> {{ $contest->contest_start_dt  }}</b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Contest End date</b>
               </label>
               <div class="col-sm-10">
                  <p><b> {{ $contest->end_dt }}</b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label for="example-email-input" class="col-sm-2 col-form-label"><b>Status</b> </label>
               <div class="col-sm-10">
                  <p><b> {{ $contest->contest_status }} </b></p>
               </div>
            </div>
            <div  class="text-center">
            <a href="{{ url('admin/contests') }}" class="btn btn-primary" type="submit">Cancel</a>
            </div>
         
            </div>
          
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
<!-- end row -->
@endsection