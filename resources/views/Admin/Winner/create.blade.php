@extends('Admin.Master.master')
@section('title', 'Winner Add | Caramia')
@section('content')
{{-- <div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body"> --}}
            {{-- <form action="{{ url('admin/getVideos') }}" method="post"> --}}
               {{-- @csrf --}}
               <div class="row mb-3">
                  <label for="example-email-input" class="col-sm-2 col-form-label"><b>Choose Contest</b> </label>
                  <div class="col-sm-4">
                     <input type="text" name="" id="contestId" hidden>
                     <select class="js-example-matcher form-control select2-search-disable" id="contest" onchange="getContestVideos(this.value)" name="contest_id" value="{{ old('contest_id') }}">
                        <option value="">Select Contest</option>
                        @foreach($contests as $contest)
                        <option value="{{ $contest->id }}">{{ $contest->contest_name }}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('contest_id'))
                     <span class="text-danger">{{ 'Contest Name is Required' }}</span>
                     @endif
                  </div>
               </div>
               {{-- <button class="btn btn-success btn-sm" type="submit">Get Videos</button> --}}
            {{-- </form> --}}
          
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="table-responsive mt-3">
                           <table class="table table-centered datatable responsive-datatable nowrap table-sm w-100">
                              <thead class="thead-light">
                                 <tr>
                                    <th>Name</th>
                                    <th>Video</th>
                                    <th>Uploaded By</th>
                                    <th>Contest Name</th>
                                    <th>Position</th>
                                    
                                 </tr>
                              </thead>
                              <tbody id="videos_s">
                                 {{-- {{ $data_s ?? '' }} --}}
                                 {{-- {{ print_r(@$data_s) }} --}}
                              </tbody>
                           </table>
                        </div>
                     </div>
                   
                  </div>
               </div>
            </div>
          
         {{-- </div>
      </div>
   </div>
</div> --}}

<!-- end col -->

<!-- end row -->
<div class="modal fade" id="exampleModal" tabindex="-1"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="v_name">
            </h1>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="javascript:window.location.reload()"><i class="fa fa-close"></i></button>
            {{--   --}}
         </div>
         <div class="modal-body">

           
            <video id="v_video" width="100%" height="100%" controls>
                   
            </video>
            {{-- <div id="videoLink">
            </div> --}}
             {{-- <video width="400" height="200" controls> 
                 
            </video> --}}
         </div>
      </div>
   </div>
</div>
@endsection
@section('select2')
<script>
   function matchCustom(params, data) {
   if ($.trim(params.term) === '') {
   
     return data;
   
   }
   if (typeof data.text === 'undefined') {
   
     return null;
   
   }
   if (data.text.indexOf(params.term) > -1) {
   
     var modifiedData = $.extend({}, data, true);
   
     modifiedData.text += ' (matched)';
      return modifiedData;
   
   }
   return null;
   
   }
   
   $(".js-example-matcher").select2({
   
   matcher: matchCustom
   
   });
   
   
   
</script>
@endsection
@section('contestVideoDropdown')
<script>
   jQuery(document).ready( function() {
       jQuery('#contest').change( function() {
           let contestId = jQuery(this).val();
           jQuery.ajax({
               url: 'getVideos',
               type: 'post',
               data: 'cid='+contestId+'&_token={{csrf_token()}}',
               success:function(result) {
                   jQuery('#video_id').html(result);
                   jQuery('#contestId').val(contestId);
               }
           });
       });
   
   });
     
</script>
@endsection
@section('VideoUserDropdown')
<script>
   jQuery(document).ready( function() {
       jQuery('#video_id').change( function() {
           let videoId = jQuery(this).val();
              jQuery.ajax({
               url: 'getUser',
               type: 'post',
               data: 'videoId='+videoId+'&_token={{csrf_token()}}',
               success:function(result) {
                   jQuery('#userInfo').html(result);
               }
           });
       });
   
   });
     
</script>
@endsection
@section('modal')
<script>
   function playVideo(id) {
      const pathArray = window.location.pathname.split("/");
           if(pathArray[4]){
               urL = 'show_video/'+id;
           }else{
               urL = 'videos/show_video/'+id;
           }
           $.ajax({
               url: urL,
               type: 'GET',
               data: {
                   "id": id
               },
               success:function(data) {
                   var video_src ='<?php echo asset("storage/uservideo/'+data.v_video+'");?>';
                   var fst_part = '<source src="'+video_src+'" type="video/mp4">';
                   $('#v_name').html(data.v_name);                   
                   $('#v_video').html(fst_part);

                   //$('#videoLink').html("<source src='"+video_src+"'  type='video/mp4'>");
               } 
           })
   }
   
     
   
   
</script>
@endsection
@section('winnerDropDown')
<script>

function myFunction(rating,video_id,contest_id,user_id) { 
  var v_voting = rating;
  var video_id = video_id;
  var contest_id =  contest_id;
  var user_id =  user_id;
  var contestId = $('#contestId').val();
// alert(contestId);

   $.ajax({
               url: 'uplode-winner',
               type: 'POST',
               data: {
                   "v_voting": v_voting,
                   "video_id": video_id,
                   "contest_id": contest_id,
                   "user_id": user_id,
                   "_token": "{{ csrf_token() }}"
               },
               success:function(data) {
                 console.log(data.list);
                  $('#videos_s').html(data.list);
                  
                   swal(data.msg);
                  console.log(data);
               } 
           })


}

</script>
@endsection
@section('getContestVideos')
<script>
function getContestVideos(contest_id) {
var contest_id = contest_id;
 $.ajax({
               url: 'getVideos',
               type: 'POST',
               data: {
                  
                   "contest_id": contest_id,
                  
                   "_token": "{{ csrf_token() }}"
               },
               success:function(result) {
                  jQuery('#videos_s').html(result)
                  
                   
                  
               } 
           })
}
</script>
@endsection
