





@extends('Admin.Master.master')

@section('title', 'User Add | Caramia')

@section('content')

    



<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                @if(Session::has('msg'))

                <p class="alert alert-info">{{ Session::get('msg') }}</p>

                @endif

          

                <h4 class="card-title">Create New User</h4>

                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

                    @csrf 



                    
                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b> <span class="text-danger">*</span></label>

                        <div class="col-sm-10">

                            <div class="caramia_radio_box">
                                <input value="Mr." type="radio" id="" name="title" checked>
                                <label for="" >Mr.</label>
                                <input value="Ms." type="radio" id="" name="title">
                                <label for="">Ms.</label>
                                <input value="Mrs." type="radio" id="" name="title">
                                <label for="">Mrs.</label>
                            </div>


                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Family name:</b><span class="text-danger">*</span></label>

                        <div class="col-sm-10">

                            <input name="family_name" class="form-control" type="text" placeholder="Enter family name...." id="example-text-input" value="{{ old('family_name') }}">

                            @if ($errors->has('family_name'))

                                <span class="text-danger">{{ $errors->first('family_name') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Name:</b><span class="text-danger">*</span></label>

                        <div class="col-sm-10">

                            <input name="name" class="form-control" type="text" placeholder="Enter name...." id="example-text-input" value="{{ old('name') }}">

                            @if ($errors->has('name'))

                                <span class="text-danger">{{ $errors->first('name') }}</span>

                            @endif

                        </div>

                    </div>



                    

            

                <div class="row mb-3">

                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Email</b><span class="text-danger">*</span></label>

                    <div class="col-sm-10">

                        <input name="email" class="form-control" type="email" placeholder="h4l@example.com" id="example-email-input" value="{{ old('email') }}">

                        @if ($errors->has('email'))

                            <span class="text-danger">{{ $errors->first('email') }}</span>

                        @endif

                    </div>

                </div>



                




               



                <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Image:</b></label>

                        <div class="col-sm-10">

                            <input name="image" class="form-control" type="file" placeholder="Enter image...." id="example-text-input" value="{{ old('image') }}">

                            @if ($errors->has('image'))

                                <span class="text-danger">{{ $errors->first('image') }}</span>

                            @endif

                        </div>

                    </div>



                    <div class="row mb-3">



                        <label for="example-email-input" class="col-sm-2 col-form-label"><b>Date of birth</b><span class="text-danger">*</span> </label>

                        <div class="col-sm-10">

                           <input type="date" name="dob" class="form-control">

                        </div>

    

                    </div>

                    <div class="row mb-3">

                    <div class="form-group form-check">

                        <input name="termsAccept" type="checkbox" class="form-check-input" id="exampleCheck1" @if ('checked')

                         value="1"

                         @else

                         value="0"   

                        @endif >
                        <span class="text-danger">*</span>
                        <label class="form-check-label" for="exampleCheck1">Accept The <a href="#" target="_blank" rel="noopener noreferrer">Terms & Conditions</a>  </label>

                        @if ($errors->has('termsAccept'))

                                <span class="text-danger">{{ $errors->first('termsAccept') }}</span>

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