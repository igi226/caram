@extends('Admin.Master.master')

@section('title', 'profile | Caramia')

@section('content')

    



<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                @if(Session::has('msg'))

                <p class="alert alert-info">{{ Session::get('msg') }}</p>

                @endif

                

                <h4 class="card-title"><b>Profile</b></h4>

                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">

                    @csrf 

                <div class="row mb-3">

                    <label for="example-text-input" class="col-sm-2 col-form-label"><b>Name:</b></label>

                    <div class="col-sm-10">

                        <input name="name" class="form-control" type="text" placeholder="Enter name...." id="example-text-input" value="{{ $admin_profile->name }}">

                        @if ($errors->has('name'))

                            <span class="text-danger">{{ $errors->first('name') }}</span>

                        @endif

                    </div>

                </div>

            

                <div class="row mb-3">

                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Email:</b></label>

                    <div class="col-sm-10">

                        <input name="email" class="form-control" type="email" placeholder="Enter email...." id="example-email-input" value="{{$admin_profile->email}}">

                        @if ($errors->has('email'))

                            <span class="text-danger">{{ $errors->first('email') }}</span>

                        @endif

                    </div>

                </div>



                <div class="row mb-3">

                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Phone:</b></label>

                    <div class="col-sm-10">

                        <input name="phone" class="form-control" type="text" placeholder="Enter phone...." id="example-email-input" value="{{$admin_profile->phone}}">

                        @if ($errors->has('phone'))

                            <span class="text-danger">{{ $errors->first('phone') }}</span>

                        @endif

                    </div>

                </div>

             

                    <label for="example-text-input" class="col-sm-2 col-form-label"><b>Current  Image:</b></label>

                    @if (isset($admin_profile->image) && !empty($admin_profile->image && File::exists(public_path("storage/UserImage/" . $admin_profile->image))))

                        <img height="80" width="100" src="{{ asset('/storage/UserImage/'.$admin_profile->image)}}" alt=""><br><br>

                @else 

                    <img height="80" width="100" src="{{asset('noimg.png')}}" alt="no-image"><br><br>

                @endif

                

                <div class="row mb-3">

                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>New Image</b></label>

                    <div class="col-sm-10">

                        <input name="image" class="form-control" accept=".jpg, .png, .jpeg|image/*" type="file"  id="example-email-input" value="{{$admin_profile->image}}" >

                        @if ($errors->has('image'))

                            <span class="text-danger">{{ $errors->first('image') }}</span>

                        @endif

                    </div>

                </div>

                

                

                

                

                <div>

                    <button class="btn btn-primary"  type="submit">Update</button>

                </div>

            </form>

            </div>

        </div>

    </div> <!-- end col -->

</div>



@endsection