@extends('Admin.Master.master')

@section('title', 'User Edit | Caramia')

@section('content')

    



<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                @if(Session::has('msg'))

                <p class="alert alert-info">{{ Session::get('msg') }}</p>

                @endif

          

                <h4 class="card-title">Edit New User</h4>

                <form action="{{ route('user.update', $particular_user->slug) }}" method="post" enctype="multipart/form-data">

                    @csrf 



                    <div class="row mb-3">

                        <div class="caramia_radio_box">
                            <input value="Mr." type="radio" id="" name="title" {{ $particular_user->title == "Mr." ? "checked" : "" }}>
                            <label for="" >Mr.</label>
                            <input value="Ms." type="radio" id="" name="title" {{ $particular_user->title == "Ms." ? "checked" : "" }}>
                            <label for="">Ms.</label>
                            <input value="Mrs." type="radio" id="" name="title" {{ $particular_user->title == "Mrs." ? "checked" : "" }}>
                            <label for="">Mrs.</label>
                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Family Name:</b></label>

                        <div class="col-sm-10">

                            <input name="family_name" class="form-control" type="text" placeholder="Enter family name...." id="example-text-input" value="{{ $particular_user->family_name }}">

                            @if ($errors->has('family_name'))

                                <span class="text-danger">{{ $errors->first('family_name') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Name:</b></label>

                        <div class="col-sm-10">

                            <input name="name" class="form-control" type="text" placeholder="Enter name...." id="example-text-input" value="{{ $particular_user->name }}">

                            @if ($errors->has('name'))

                                <span class="text-danger">{{ $errors->first('name') }}</span>

                            @endif

                        </div>

                    </div>



                    

            

                <div class="row mb-3">

                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Email</b></label>

                    <div class="col-sm-10">

                        <input name="email" class="form-control" type="email" placeholder="h4l@example.com" id="example-email-input" value="{{ $particular_user->email }}">

                        @if ($errors->has('email'))

                            <span class="text-danger">{{ $errors->first('email') }}</span>

                        @endif

                    </div>

                </div>

                <div class="row mb-3">



                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Date of birth</b><span class="text-danger">*</span> </label>

                    <div class="col-sm-10">

                       <input type="date" name="dob" class="form-control" value="{{ $particular_user->dob }}">

                    </div>



                </div>

                <label for="example-email-input" class="col-sm-2 col-form-label"><b>Old Image</b></label>

                @if (isset($particular_user->image) && !empty($particular_user->image && File::exists(public_path("storage/UserImage/" . $particular_user->image))))

                        <img height="80" width="100" src="{{ asset('/storage/UserImage/'.$particular_user->image)}}" alt=""><br><br>

                @else 

                    <img height="80" width="100" src="{{asset('noimg.png')}}" alt="no-image"><br><br>

                @endif



                <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Image:</b></label>

                        <div class="col-sm-10">

                            <input name="image" class="form-control" type="file" placeholder="Enter image...." id="example-text-input" value="{{ $particular_user->image }}">

                            @if ($errors->has('image'))

                                <span class="text-danger">{{ $errors->first('image') }}</span>

                            @endif

                        </div>

                    </div>

                

                

                

                <div class="text-center">

                    <button class="btn btn-primary"  type="submit">Update</button>

                    

                </div>

            </form>

            </div>

        </div>

    </div> <!-- end col -->

</div>

<!-- end row -->

@endsection