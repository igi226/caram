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
   <h4>Cms details</h4>
   <div class="row">
      <div class="col-md-9 mt-5">
         <div class="float-left">
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Title:</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b>{{ $cms->title  }} </b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Short description</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b>{{ $cms->short_desc  }} </b></p>
               </div>
            </div>
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Description:</b></label>
               <div class="col-sm-10 ml-5">
                  <p><b> <?php echo html_entity_decode($cms->description);?> </b></p>
               </div>
            </div>
           
            <div class="row mb-3">
               <label class="col-sm-2 col-form-label"><b>Image:</b></label>
               <div class="col-sm-10 ml-5">
                  @if (isset($cms->image) &&
                  !empty($cms->image && File::exists(public_path('storage/CmsImage/' . $cms->image))))
                  <td><img src="{{ asset('/storage/CmsImage/' . $cms->image) }}" alt="" class="w3-margin" width="150" height="130" style="border-radius: 50%;"></td>
                  @else
                  <td><img height="80" width="100" src="{{ asset('noimg.png') }}" alt="no-image"> </td>
                  @endif
               </div>
            </div>
           
            
         </div>
      </div>
      
   </div>
   
</div>
@endsection
