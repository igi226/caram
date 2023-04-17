@extends('Admin.Master.master')

@section('title', 'Dashboard | Caramia')

@section('content')









    <!-- start page title -->

    <h1 class="align-right">Welcome to Dashboard</h1>

    <div class="row">





        <div class="col-12">

            <div class="page-title-box d-flex align-items-center justify-content-between">

                <h4 class="mb-0">Dashboard</h4>







            </div>

        </div>

    </div>

    <!-- end page title -->



    <div class="row">

        <div class="col-xl-12">

            <div class="row h-100">

                <div class="col-md-6 col-xl-4">

                    <div class="card overflow-hidden card-h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <h5 class="font-size-15 text-uppercase mb-0">Total Users</h5>

                                <div class="avatar-xs">

                                    <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">

                                        <i class="ri-user-line text-primary"></i>

                                    </span>

                                </div>

                            </div>

                            <h3 class="font-size-24">{{ $users }}</h3>

                            <p class="text-muted mb-0">Total list of Users with active Video Submissions</p>

                        </div><!-- end card-body -->



                        <!-- Project chart -->

                        <div id="project-chart"></div>

                    </div><!-- end card -->

                </div><!-- end col-->



                <div class="col-md-6 col-xl-4">

                    <div class="card overflow-hidden card-h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <h5 class="font-size-15 text-uppercase mb-0">Total Contests</h5>

                                <div class="avatar-xs">

                                    <span class="avatar-title rounded bg-soft-success font-size-20 mini-stat-icon">

                                        <i class="ri-wallet-3-line text-success"></i>

                                    </span>

                                </div>

                            </div>

                            <h3 class="font-size-24">{{ $contests }}

                                {{-- <span class="text-danger fw-normal font-size-14 ms-2">+3.16%</span> --}}

                            </h3>

                            <p class="text-muted mb-0">Total list of Active Contests</p>

                        </div><!-- end card-body -->



                        <!-- user chart -->

                        <div id="user-chart"></div>

                    </div><!-- end card -->

                </div><!-- end col-->



                <div class="col-xl-4">

                    <div class="card overflow-hidden card-h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <h5 class="font-size-15 text-uppercase mb-0">Total Videos</h5>

                                <div class="avatar-xs">

                                    <span class="avatar-title rounded bg-soft-danger font-size-20 mini-stat-icon">

                                        <i class="ri-shopping-cart-line text-danger"></i>

                                    </span>

                                </div>

                            </div>

                            <h3 class="font-size-24">{{ $videos }}

                            </h3>

                            <p class="text-muted mb-0">Total Number Active Videos </p>

                        </div><!-- end card-body -->



                        <!-- order chart -->

                        <div id="order-chart"></div>

                    </div><!-- end card -->

                </div><!-- end col -->

            </div><!-- end row -->

        </div><!-- end col -->



     

    </div><!-- end row-->







    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title mb-4">Latest Videos This Week</h4>



                    <div class="table-responsive">

                        <table class="table table-centered table-nowrap mb-0">

                            <thead class="thead-light">

                                <tr>

                                    <th>Video Name</th>

                                    <th>Posted By</th>


                                    <th>Contest Name</th>

                                    <th>Action</th>

                                </tr>

                            </thead>



                            <tbody>
                                @foreach ($latest_videos as $item)
                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div class="flex-grow-1 ms-3">

                                                    <div>{{ $item->v_name }}</div>

                                                </div>

                                            </div>

                                        </td>

                                        <td>{{ $item->videoOwner->name }}</td>



                                        <td><span
                                                class="badge rounded-pill badge-soft-success font-size-12">{{ @$item->videoContest->contest_name }}</span>

                                        </td>

                                        <td><a href="{{ url('admin/view-video', $item->v_slug) }}"
                                                class="btn btn-outline-secondary btn-sm">View Details</a></td>

                                    </tr>
                                @endforeach



                            </tbody>

                        </table>

                    </div>
                    <a class="me-auto" href="{{ url('admin/videos') }}" class="btn btn-success">View All</a>
                </div><!-- end card-body -->




            </div><!-- end card -->

        </div><!-- end col -->







    </div><!-- end col -->



@endsection
