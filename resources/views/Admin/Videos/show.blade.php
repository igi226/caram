@extends('Admin.Master.master')
@section('title', 'Videos | Caramia')
@section('tagcss')
<style>
   /* video */
   .video {
   width: 100%;
   border: 1px solid black;
   }
   .wrapper {
   display: table;
   width: auto;
   position: relative;
   width: 50%;
   }
   .playpause {
   background-image: url(http://png-4.findicons.com/files/icons/2315/default_icon/256/media_play_pause_resume.png);
   background-repeat: no-repeat;
   width: 50%;
   height: 50%;
   position: absolute;
   left: 0%;
   right: 0%;
   top: 0%;
   bottom: 0%;
   margin: auto;
   background-size: contain;
   background-position: center;
   }
   /*V END  */
</style>
@endsection
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-flex align-items-center justify-content-between">
         <h4 class="mb-0">List of all Videos</h4>
      </div>
   </div>
</div>
<!-- end page title -->
<div class="row">
   <div class="col-4">
      <div class="page-title-box d-flex align-items-center justify-content-between">
         <h4 class="mb-0">Filter By Contests</h4>
         <form  method="post" role="form">
         <select class="js-example-matcher form-control select2-search-disable" id="contest" name="contest_id" value="{{ old('contest_name') }}">
            <!-- onchange="javascript:doUrl(event)"  -->
            <option value="">Select Contest</option>
            @foreach($contests as $contest)
            <option value="{{ $contest->id }}">{{ $contest->contest_name }}</option>
            @endforeach
         </select>
         </form>
         <a id="linkEdit" type="button" class="btn btn-success btn-sm" onclick="getSearch()">Filter </a>
         
      </div>
   </div>
</div>
</div>
<div class="row">
   <div class="col-lg-12">
   @if(Session::has('msg'))
     <p class="alert alert-info">{{ Session::get('msg') }}</p>
   @endif
      <div class="card">
         <div class="card-body">
            <div class="table-responsive mt-3">
               <table class="table table-centered datatable responsive-datatable nowrap table-sm w-100">
                  <thead class="thead-light">
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Video</th>
                      <th>Uploaded By</th> 
                        <th>Contest Name</th>
                        {{-- <th>Status</th> --}}
                        <th>Action</th>
                        {{-- <th>Winner</th> --}}
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($videos as $item)
                     <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>
                           <b>{{ $item->v_name }}</b>
                        </td>
                        @if (isset($item->v_video) &&
                        !empty($item->v_video && File::exists(public_path('storage/uservideo/' . $item->v_video))))
                        <td width="100">
                           <div class="video-layer">
                              <video>
                                 <source src="{{ asset('storage/uservideo/' . $item->v_video) }}"
                                    type="video/mp4">
                              </video>
                              <button class="videoplaybtn" data-bs-toggle="modal"
                                 data-bs-target="#exampleModal" data-id="{{ $item->id }}"><i
                                 class="fa fa-play"></i></button>
                           </div>
                        </td>
                        @else
                        <td><img height="80" width="100" src="{{ asset('noimg.png') }}"
                           alt="no-image"> </td>
                        @endif
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contest_name }}</td>
                        {{-- <td><label class="switch">
                           <input class="changeS" type="checkbox" data-id="{{ $item->v_slug }}"
                           {{ $item->v_status == 1 ? 'checked' : '' }}>
                           <span class="slider round"></span>
                           </label>
                        </td> --}}
                        <td id="tooltip-container1">
                           <a href="{{ url('admin/edit-videos', $item->v_slug) }}"
                              class="me-3 text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                              title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                           <a href="{{ url('admin/view-video', $item->v_slug) }}" class="me-3 text-success" data-bs-toggle="tooltip"
                              data-bs-placement="top" title="View"><i class="fa fa-eye font-size-18"
                              style="font-size: 20px"></i></a>
                           <form method="POST" action="{{ route('deletevideo', $item->v_slug) }}"
                              class="action-icon">
                              @csrf
                              <input name="_method" type="hidden" value="DELETE">
                              <button type="submit" class="delete-icon show_confirm"
                                 data-toggle="tooltip" title='Delete'>
                              <i class="fa fa-trash-o font-size-18 text-danger"></i>
                              </button>
                           </form>
                        </td>
                       
                     </tr>
                
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         {{--  --}}
      </div>
   </div>
</div>
{{-- modal --}}

     <div class="modal fade" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="v_name">
                    </h1>
                    
        <button type="button" class="btn btn-danger" onclick="javascript:window.location.reload()" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <video id="v_video" width="100%" height="100%" controls>
                    
                    </video>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
<script>
$('#exampleModal').on('hidden.bs.modal', function () {
 location.reload();
})

   $(document).ready(function () {
    $('.videoplaybtn').click(function () {
        const id = $(this).attr('data-id');
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
               
                var video_src ='<?php echo asset("storage/uservideo/'+data.v_video+'") ?>';
                var fst_part = '<source src="'+video_src+'" type="video/mp4">';
                $('#v_name').html(data.v_name);
                
                $('#v_video').html(fst_part);
            } 
        })
    });
   });


</script>
@endsection

@section('filter')
<script>
            // function doUrl(e){
            //     $('#linkEdit').attr('href','/caramiamedia/admin/videos/'+e.target.value)
            // }
            
            function getSearch() {

                var id = $("#contest option:selected").val();
                if(id !=''){
                    $('#linkEdit').attr('href','/caramiamedia/admin/videos/'+id);
                }else{
                    $('#linkEdit').attr('href','/caramiamedia/admin/videos');
                }
           
 
               
            }
         </script>
@endsection

@section('msg')
<script>
   @if ($msg = session('msg'))
       swal("{{ $msg }}");
   @endif
</script>
@endsection
@section('status')
<script>
   $(document).ready(function() {
   
       $("#tb"), DataTable()
   
   });
   
   $(function() {
   
       $('.changeS').change(function() {
   
   
   
           var status = $(this).prop('checked') == true ? 1 : 0;
   
           var data_id = $(this).attr('data-id');
   
           // alert(data_id);
   
           $.ajax({
   
               type: "GET",
   
               url: "{{ url('admin/changeVS') }}",
   
               data: {
   
                   'v_status': status,
   
                   'v_slug': data_id,
   
                   '_token': '{{ csrf_token() }}'
   
               },
   
               dataType: "JSON",
   
               success: function(response) {
   
                  
   
                   swal('Successfully Updated');
    console.log(response);
                   // location.reload();
   
               }
   
           });
   
       })
   
   })
</script>
@endsection
@section('winner')
<script>
   $(document).ready(function() {
   
       $("#tb"), DataTable()
   
   });
   
   $(function() {
   
       $('.changeWS').change(function() {
   
   
   
           var is_winner = $(this).prop('checked') == true ? 1 : 0;
   
           var data_id = $(this).attr('data-id');
   
           // alert(data_id);
   
           $.ajax({
   
               type: "GET",
   
               url: "{{ url('admin/changeWS') }}",
   
               data: {
   
                   'is_winner': is_winner,
   
                   'v_slug': data_id,
   
                   '_token': '{{ csrf_token() }}'
   
               },
   
               dataType: "JSON",
   
               success: function(response) {
                   //location.reload();
                   console.log(response);
   
                  // swal(response.msg);
                  swal(response.msg, "Please Click Ok to Finish The task!", "success").then(function(){
                       location.reload();
                   });
   
                   
   
               }
   
           });
   
       })
   
   })
</script>
@endsection

