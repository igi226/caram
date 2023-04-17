





@extends('Admin.Master.master')

@section('title', 'Cms Add | Caramia')

@section('content')

    



<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                @if(Session::has('msg'))

                <p class="alert alert-info">{{ Session::get('msg') }}</p>

                @endif

          

                <h4 class="card-title">Create New User</h4>

                <form action="{{ route('cms.store') }}" method="post" enctype="multipart/form-data">

                    @csrf 



                    
                   

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b><span class="text-danger">*</span></label>

                        <div class="col-sm-10">

                            <input name="title" class="form-control" type="text" placeholder="Enter family name...." id="example-text-input" value="{{ old('title') }}">

                            @if ($errors->has('title'))

                                <span class="text-danger">{{ $errors->first('title') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Short Description:</b></label>

                        <div class="col-sm-10">

                            <input name="short_desc" class="form-control" type="text" placeholder="Enter short desc...." id="example-text-input" value="{{ old('short_desc') }}">

                            @if ($errors->has('short_desc'))

                                <span class="text-danger">{{ $errors->first('short_desc') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Short Description:</b></label>

                        <div class="col-sm-10">

                           <textarea id="your_summernote" class="form-control" name ="description">{{ old("description") }}</textarea>

                            @if ($errors->has('description'))

                                <span class="text-danger">{{ $errors->first('description') }}</span>

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

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Video:</b></label>

                        <div class="col-sm-10">

                            <input name="video" class="form-control" type="file" id="example-text-input" accept="video/mp4,video/x-m4v,video/*">

                            @if ($errors->has('video'))

                                <span class="text-danger">{{ $errors->first('video') }}</span>

                            @endif

                        </div>

                    </div>



                    

                    

                

                

                

                <div class="text-center">

                    <button class="btn btn-primary"  type="submit">Create</button>

                    

                </div>

            </form>

            </div>

        </div>

    </div> <!-- end col -->

</div>

<!-- end row -->

@endsection