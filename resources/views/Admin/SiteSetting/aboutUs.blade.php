@extends('Admin.Master.master')

@section('title', 'Privacy | Caramia')

@section('content')





    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    @if (Session::has('msg'))

                        <p class="alert alert-info">{{ Session::get('msg') }}</p>

                    @endif



                    <h4 class="card-title">Edit About Us</h4>

                    <form action="{{ route('about.Update') }}" method="post">

                        @csrf













                        <div class="row mb-3">

                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Privacy</b></label>

                            <div class="col-sm-10">

                                @if ($aboutUs->aboutUs != null && !empty($aboutUs->aboutUs))



                                    <textarea name="aboutUs" id="your_summernote" class="form-control" rows="40">{{ $aboutUs->aboutUs }}</textarea>

                                @else

                                    <textarea name="aboutUs" id="your_summernote" class="form-control" rows="40">No About Us</textarea>

                                @endif

                                @if ($errors->has('aboutUs'))

                                    <span class="text-danger">{{ $errors->first('aboutUs') }}</span>

                                @endif

                            </div>

                        </div>













                        <div class="text-center">

                            <button class="btn btn-primary">Update</button>

                            <a href="{{ url('admin/dashboard') }}" class="btn btn-danger">Cancel</a>

                        </div>

                    </form>

                </div>

            </div>

        </div> <!-- end col -->

    </div>

@endsection

