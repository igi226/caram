@extends('Admin.Master.master')

@section('title', 'profile | Caramia')

@section('content')







    <div class="container">



        <div class="row justify-content-center">



            <div class="col-md-8">



                <div class="card">



                    @if (Session::has('msg'))

                        <p class="alert alert-info">{{ Session::get('msg') }}</p>

                    @endif



                    @if (Session::has('msgEr'))

                        <p class="alert alert-danger">{{ Session::get('msgEr') }}</p>

                    @endif



                    



                    <div class="card-header"><b>Change Password</b></div>







                    <div class="card-body">



                        <form method="POST" action="{{ route('adminpassword.update') }}">



                            @csrf

                             <div class="form-group row">



                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>







                                <div class="col-md-6">



                                    <input id="password" type="password" class="form-control" name="current_password"

                                        autocomplete="current-password">

                                    @if ($errors->has('current_password'))

                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>

                                    @endif

                                </div>



                            </div><br>







                            <div class="form-group row">



                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>







                                <div class="col-md-6">



                                    <input id="new_password" type="password" class="form-control" name="new_password"

                                        autocomplete="current-password">

                                    @if ($errors->has('new_password'))

                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>

                                    @endif

                                </div>



                            </div><br>







                            <div class="form-group row">



                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm

                                    Password</label>







                                <div class="col-md-6">



                                    <input id="new_confirm_password" type="password" class="form-control"

                                        name="new_confirm_password" autocomplete="current-password">

                                    @if ($errors->has('new_confirm_password'))

                                        <span class="text-danger">{{ $errors->first('new_confirm_password') }}</span>

                                    @endif

                                </div>



                            </div>



                            <br>



                            <div class="form-group row mb-0">



                                <div class="col-md-8 offset-md-4">



                                    <button type="submit" class="btn btn-primary">



                                        Update Password



                                    </button>



                                </div>



                            </div>



                        </form>



                    </div>



                </div>



            </div>



        </div>



    </div>



@endsection

