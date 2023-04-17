<?php
   use Illuminate\Support\Facades\DB;
   
   $admin = DB::table('users')
   
       ->where('role', 'admin')
   
       ->select('name', 'image')
   
       ->first();
   
   $site_info = DB::table('site_settings')->first();
   
   
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title> @yield('title') </title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="" name="description" />
      <meta content="" name="author" />
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{ asset('storage/SiteImages/' . $site_info->favicon_image) }}">
      <!-- jquery.vectormap css -->
      <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
         rel="stylesheet" type="text/css" />
      <!-- Bootstrap Css -->
      <link href="{{ asset('admin-asset/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
         rel="stylesheet" type="text/css" />
      <!-- Bootstrap Css -->
      <link href="{{ asset('admin-asset/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
         type="text/css" />
      <!-- Icons Css -->
      <link href="{{ asset('admin-asset/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- App Css-->
      <link href="{{ asset('admin-asset/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
      <!-- DataTables -->
      <link href="{{ asset('admin-asset/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
         rel="stylesheet" type="text/css" />
      <!-- Responsive datatable examples -->
      <link href="{{ asset('admin-asset/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
         rel="stylesheet" type="text/css" />
      {{-- added --}}
      {{-- fontaswm w3school --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
      {{-- statusbar --}}
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
      {{-- selece2 --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
      @yield('progressbar')
   </head>
   <body data-topbar="dark">
      <!-- <body data-layout="horizontal" data-topbar="dark"> -->
      <!-- Begin page -->
      <div id="layout-wrapper">
      <header id="page-topbar">
         <div class="navbar-header">
            <div class="d-flex">
               <!-- LOGO -->
               <div class="navbar-brand-box">
                  <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
                  <span class="logo-sm">
                  <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
                     height="22">
                  </span>
                  <span class="logo-lg">
                  <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
                     height="22">
                  </span>
                  </a>
                  <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
                  <span class="logo-sm">
                  <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
                     height="22">
                  </span>
                  <span class="logo-lg">
                  <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
                     height="22">
                  </span>
                  </a>
               </div>
               <button type="button"
                  class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
               <i class="fa fa-fw fa-bars"></i>
               </button>
            </div>
            <div class="d-flex">
               <div class="dropdown d-inline-block user-dropdown">
                  <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                     data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if (File::exists(public_path('storage/UserImage/' . $admin->image)))
                  <img class="rounded-circle header-profile-user"
                     src="{{ asset('/storage/UserImage/' . $admin->image) }}" alt="Header Avatar">
                  @else
                  <img class="rounded-circle header-profile-user" src="{{ asset('noimg.png') }}"
                     alt="no-image">
                  @endif
                  <span><i class="fa fa-angle-down"></i></span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <div class="p-3">
                        <div class="row align-items-center">
                           <div class="col">
                              <h6 class="m-0"> {{ $admin->name }}</h6>
                           </div>
                        </div>
                     </div>
                     <div data-simplebar style="max-height: 230px;">
                        <!-- item-->
                        <a href="{{ url('admin/profile') }}" class="text-reset notification-item">
                           <div class="d-flex align-items-center">
                              <div class="avatar-xs me-3 mt-1">
                                 <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                 <i class="ri-user-line text-primary font-size-16"></i>
                                 </span>
                              </div>
                              <div class="flex-grow-1 text-truncate">
                                 <h6 class="mb-1">Profile</h6>
                              </div>
                           </div>
                        </a>
                        <!-- item-->
                        <a href="{{ url('admin/change-password') }}" class="text-reset notification-item">
                           <div class="d-flex align-items-center">
                              <div class="avatar-xs me-3 mt-1">
                                 <span class="avatar-title bg-soft-warning rounded-circle font-size-16">
                                 <i class="ri-wallet-2-line text-warning font-size-16"></i>
                                 </span>
                              </div>
                              <div class="flex-grow-1 text-truncate">
                                 <h6 class="mb-1">Change Password</h6>
                              </div>
                           </div>
                        </a>
                     </div>
                     <!-- item-->
                     <div class="pt-2 border-top">
                        <div class="d-grid">
                           <a class="btn btn-sm btn-link font-size-14 text-center"
                              href="{{ route('logOut') }}">
                           <i class="ri-shut-down-line align-middle me-1"></i> Logout
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- ========== Left Sidebar Start ========== -->
      <div class="vertical-menu">
         <!-- LOGO -->
         <div class="navbar-brand-box">
            <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
            <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
               height="16">
            </span>
            <span class="logo-lg">
            <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
               height="40">
            </span>
            </a>
            <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
            <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
               height="16">
            </span>
            <span class="logo-lg">
            <img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""
               height="40">
            </span>
            </a>
         </div>
         <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
         <i class="fa fa-fw fa-bars"></i>
         </button>
         <div data-simplebar class="sidebar-menu-scroll">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                  <li>
                     <a href="{{ url('admin/dashboard') }}" class="waves-effect">
                     <i class="ri-home-gear-line"></i><span
                        class="badge rounded-pill bg-success float-end"></span>
                     <span>Dashboard</span>
                     </a>
                  </li>
                  {{-- 
                  <li>
                     <a href="{{ url('admin/cms-management') }}" class="waves-effect">
                     <i class="fa fa-film"></i><span class="badge rounded-pill bg-success float-end"></span>
                     <span>CMS</span>
                     </a>
                  </li>
                  --}}
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="fa fa-address-card-o"></i>
                     <span>User Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/users') }}">List of Users</a></li>
                        <li><a href="{{ url('admin/add-user') }}">Add New User</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="mdi mdi-video"></i>
                     <span>Video Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/videos') }}">List of Videos</a></li>
                        <li><a href="{{ url('admin/add-videos') }}">Add New Video</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>
                     <span>Contests Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/contests') }}">List of Contests</a></li>
                        <li><a href="{{ url('admin/add-contests') }}">Add New Contests</a></li>
                     </ul>
                  </li>

                    <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="fas fa-trophy"></i>
                     <span>Winner Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/winners') }}">List of Winners</a></li>
                        <li><a href="{{ url('admin/add-winner') }}">Make New Winner</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="fas fa-book"></i>
                     <span>Cms Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('cms.index') }}">List of Cms</a></li>
                        {{-- <li><a href="{{ route('cms.create') }}">Make New Cms</a></li> --}}
                     </ul>
                  </li>

                  <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="fa fa-cog"></i>
                     <span>Site Settings</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/site-setting') }}">Site Info</a></li>
                        <li><a href="{{ url('admin/terms-Conditions') }}">Terms & Cond</a></li>
                        <li><a href="{{ url('admin/privacy-policy') }}">Privacy</a></li>
                        <li><a href="{{ url('admin/about-us-update') }}">About Us</a></li>
                     </ul>
                  </li>
                  {{-- 
                  <li>
                     <a href="{{ url('admin/site-setting') }}" class="waves-effect">
                     <i class="fa fa-cog"></i>
                     <span>Site Settings</span>
                     </a>
                  </li>
                  --}}
               </ul>
            </div>
            <!-- Sidebar -->
         </div>
      </div>
      <!-- Left Sidebar End -->
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
      <!-- End Page-content -->
      <div class="page-content">
         <div class="container-fluid">
            {{-- content --}}
            @yield('content')
            <footer class="footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6">
                        <script>
                           document.write(new Date().getFullYear())
                           
                        </script> © {{ $site_info->site_name }}
                     </div>
                  </div>
               </div>
            </footer>
         </div>
         <!-- end main content-->
      </div>
      <!-- END layout-wrapper -->
      <!-- Right Sidebar -->
      <!-- /Right-bar -->
      <!-- Right bar overlay-->
      <div class="rightbar-overlay"></div>
      <!-- JAVASCRIPT -->
      <!-- JAVASCRIPT -->
      <script src="{{ asset('admin-asset/assets/libs/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/metismenu/metisMenu.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/simplebar/simplebar.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/node-waves/waves.min.js') }}"></script>
      <!-- Required datatable js -->
      <script src="{{ asset('admin-asset/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <!-- Responsive examples -->
      <script src="{{ asset('admin-asset/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('admin-asset/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
      <!-- apexcharts -->
      <script src="{{ asset('admin-asset/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
      <!-- jquery.vectormap map -->
      <script src="{{ asset('admin-asset/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
      <script
         src="{{ asset('admin-asset/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
      <script src="{{ asset('admin-assetassets/js/pages/dashboard.init.js') }}"></script>
      <!-- App js -->
      <script src="{{ asset('admin-asset/assets/js/app.js') }}"></script>
      {{-- select2 --}}
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      @yield('select2')
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
      {{-- tag --}}
      <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
       {{-- progres --}}

      <script>
         $(document).ready(function() {
         
             $("#your_summernote").summernote();
         
             $('.dropdown-toggle').dropdown();
         
         });
         
      </script>
      @yield('status')
      @yield('msg')
      @yield('contestVideoDropdown')
      @yield('VideoUserDropdown')
      @yield('progressbar')
      @yield('winner')
      @yield('modal')
      @yield('filter')
      @yield('winnerDropDown')
      @yield('getContestVideos')
      
      
      <script>
         $('.show_confirm').click(function(event) {
         
             var form = $(this).closest("form");
         
             var name = $(this).data("name");
         
             //alert(form);
         
             event.preventDefault();
         
             swal({
         
                     title: `Are you sure you want to delete this data?`,
         
                     text: "If you delete this, it will be gone forever.",
         
                     icon: "warning",
         
                     buttons: true,
         
                     dangerMode: true,
         
                 })
         
                 .then((willDelete) => {
         
                     if (willDelete) {
         
                         form.submit();
         
                     } else {
         
                         swal("Your data file is safe!");
         
                     }
         
                 });
         
         });
         
      </script>
   </body>
</html>