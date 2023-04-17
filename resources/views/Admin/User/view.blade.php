@extends('Admin.Master.master')
@section('title', 'Users Info | Caramia')
@section('userinfoCss')
<style>
   body {
   /* background: url("https://www.w3schools.com/howto/img_link_tree_template2_bg.jpg"); */
   /* The image used for background */
   }
   .container {
   width: 100%;
   height: 100%;
   padding-right: 15px;
   padding-left: 15px;
   margin-right: auto;
   margin-left: auto;
   }
   .links-container {
   display: flex;
   flex-direction: column;
   jusify-content: center;
   align-items: center;
   }
   .links-container a {
   width: 80%;
   }
   .w3-theme-l1:hover {
   background-color: #8bc4fa !important;
   }
   .margin-top-2 {
   margin-top: 32px;
   }
   .bottom {
   width: 100%;
   text-align: center;
   width: auto;
   font-weight: bolder;
   }
   .bottom span {
   color: #240610;
   }
   .bottom svg {
   stroke: #360e1c;
   fill: #290c15;
   }
   @media (min-width: 768px) {
   .link {
   width: 100%;
   }
   }
   @media (min-width: 576px) {
   .container {
   max-width: 540px;
   }
   }
</style>
@endsection
@section('content')
<div class="container-fluid">
   <!-- Image and name container. Change to your pictue here. -->
   <h4>Profile Information</h4>
   <div class="row">
      <div class="col-md-6 mt-5">
         <div class="float-left">
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Title:</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b>{{ $particular_user->title  }} </b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label class="col-sm-3 col-form-label"><b>Family name:</b></label>
               <div class="col-sm-9 ml-5">
                  <p><b>{{ $particular_user->family_name  }} </b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Name:</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b>{{ $particular_user->name  }} </b></p>
               </div>
            </div>
           
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Email:</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b>{{ $particular_user->email  }} </b></p>
               </div>
            </div>

            <div class="row mb-4">
               <label class="col-sm-3 col-form-label"><b>Date of birth:</b></label>
               <div class="col-sm-9 ml-5">
                  <p><b>{{ $particular_user->dob  }} </b></p>
               </div>
            </div>
            
            
         </div>
      </div>
      <div class="col-md-6">
         <div class="float-right">
            <div style="text-align: center;">
               @if (isset($particular_user->image) &&
               !empty($particular_user->image && File::exists(public_path('storage/UserImage/' . $particular_user->image))))
               <td><img src="{{ asset('/storage/UserImage/' . $particular_user->image) }}" alt="" class="w3-margin" width="150" height="130" style="border-radius: 50%;"></td>
               @else
               <td><img height="80" width="100" src="{{ asset('noimg.png') }}" alt="no-image"> </td>
               @endif
               
               <p style="font-weight: bolder;">Check out my videos!</p>
            </div>
            <!-- Links section 1. Replace the # inside of the "" with your links. -->
            <!-- <h4 class="margin-top-2" >MY Videos</h4> -->
            <div class="links-container" style="text-align: center;">
               @foreach ($particular_user->userVideos as $item)
               <div class="w3-button w3-round-xlarge w3-theme-l1 w3-border link">
                  <a href="{{ url('admin/view-video', $item->v_slug) }}" target="_blank">{{ $item->v_name }}</a>
               </div>
               <br>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   <!-- Bottom section 3 -->
   <!-- <div class="bottom margin-top-2 w3-padding w3-round">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
         <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
         </path>
      </svg>
      <span style="vertical-align: 7px;">
         <script>
            document.write(new Date().getFullYear())
         </script> {{ $particular_user->name }}.
      </span>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
         <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
         </path>
      </svg>
   </div> -->
</div>
@endsection
@section('userinfoJs')
<script>
   feather.replace()
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
   
           // var data_id = $(this).data('testiidmonial_id');
   
           //alert(data_id);
   
           $.ajax({
   
               type: "GET",
   
               url: "{{ url('admin/changeProductS') }}",
   
               data: {
   
                   'status': status,
   
                   'slug': data_id,
   
                   '_token': '{{ csrf_token() }}'
   
               },
   
               dataType: "JSON",
   
               success: function(response) {
   
                   console.log(response);
   
                   alert('Successfully Updated');
   
                   location.reload();
   
               }
   
           });
   
       })
   
   })
</script>
@endsection