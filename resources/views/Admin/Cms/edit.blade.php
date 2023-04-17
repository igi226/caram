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

          

                <h4 class="card-title">Edit Cms</h4>

                <form action="{{ route('cms.update', $cms->slug) }}" method="post" enctype="multipart/form-data">

                    @csrf 
                    @method('PUT')
                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b><span class="text-danger">*</span></label>

                        <div class="col-sm-10">

                            <input name="title" class="form-control" type="text" placeholder="Enter family name...." id="example-text-input" value="{{ $cms->title }}">

                            @if ($errors->has('title'))

                                <span class="text-danger">{{ $errors->first('title') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Short Description:</b></label>

                        <div class="col-sm-10">

                            <input name="short_desc" class="form-control" type="text" placeholder="Enter short desc...." id="example-text-input" value="{{ $cms->short_desc }}">

                            @if ($errors->has('short_desc'))

                                <span class="text-danger">{{ $errors->first('short_desc') }}</span>

                            @endif

                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Description:</b></label>

                        <div class="col-sm-10">

                           <textarea id="your_summernote" class="form-control" name ="description">{{ $cms->description }}</textarea>

                            @if ($errors->has('description'))

                                <span class="text-danger">{{ $errors->first('description') }}</span>

                            @endif

                        </div>

                    </div>



                <label for="example-email-input" class="col-sm-2 col-form-label"><b>Old Image</b></label>

                @if (isset($cms->image) && !empty($cms->image && File::exists(public_path("storage/CmsImage/" . $cms->image))))

                        <img height="80" width="100" src="{{ asset('/storage/CmsImage/'.$cms->image)}}" alt=""><br><br>

                @else 

                    <img height="80" width="100" src="{{asset('noimg.png')}}" alt="no-image"><br><br>

                @endif



                <div class="row mb-3">

                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Image:</b></label>

                        <div class="col-sm-10">

                            <input name="image" class="form-control" type="file" placeholder="Enter image...." id="example-text-input" value="{{ $cms->image }}">

                            @if ($errors->has('image'))

                                <span class="text-danger">{{ $errors->first('image') }}</span>

                            @endif

                        </div>

                    </div>

                  

                    @if (isset($cms->video) && !empty($cms->video && File::exists(public_path("storage/CmsImage/" . $cms->video))))
                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Old video</b></label>
                           
                                <video width="320" height="240" class="rounded" controls>
                                    <source src="{{ asset('storage/CmsImage/' . $cms->video) }}" type="video/mp4">
                                    
                                   
                                </video>

                            
                   
                             <div class="row mb-3">

                                <label for="example-text-input" class="col-sm-2 col-form-label"><b>Video:</b></label>
        
                                <div class="col-sm-10">
        
                                    <input name="video" class="form-control" type="file" placeholder="Enter video...." id="example-text-input" value="{{ $cms->video }}">
        
                                    @if ($errors->has('video'))
        
                                        <span class="text-danger">{{ $errors->first('video') }}</span>
        
                                    @endif
        
                                </div>
        
                            </div>
                    @endif

                    

                

                

                

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