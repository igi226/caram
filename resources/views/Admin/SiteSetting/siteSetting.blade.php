

@extends('Admin.Master.master')
@section('title', 'Site Info | Caramia')
@section('content')
    

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
                @endif
                {{-- @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif --}}
                <h4 class="card-title">Site Settings</h4>
                <form action="{{ route('site.update') }}" method="post" enctype="multipart/form-data">
                    @csrf 

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Site Name:</b></label>
                        <div class="col-sm-10">
                            <input name="site_name" class="form-control" type="text" placeholder="Enter site_name...." id="example-text-input" value="{{ $site_settings->site_name }}">
                            @if ($errors->has('site_name'))
                                <span class="text-danger">{{ $errors->first('site_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Current Logo Image:</b></label>
                        <div class="col-sm-10">
                            @if (isset($site_settings->logo_image) && !empty($site_settings->logo_image) && File::exists(public_path("storage/SiteImages/" . $site_settings->logo_image)))
                        <img height="50" width="150" src="{{ asset('storage/SiteImages/'. $site_settings->logo_image) }}" alt=""><br><br>
                                    @else
                                    <img height="80" width="100" src="{{asset('noimg.png')}}" alt="no-p_image">    
                                    @endif
                        </div>

                       
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Logo Image:</b></label>
                        <div class="col-sm-10">
                            <input name="logo_image" class="form-control" type="file" placeholder="Enter logo_image...." id="example-text-input" value="{{ !empty($site_settings->logo_image) ? $site_settings->logo_image : '' }}">
                            @if ($errors->has('logo_image'))
                                <span class="text-danger">{{ $errors->first('logo_image') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Current Favicon Image:</b></label>
                        <div class="col-sm-10">
                            @if (isset($site_settings->favicon_image) && !empty($site_settings->favicon_image) && File::exists(public_path("storage/SiteImages/" . $site_settings->favicon_image)))
                            <img height="50" width="150" src="{{ asset('storage/SiteImages/'.$site_settings->favicon_image) }}" alt=""><br><br>
                                        @else
                                        <img height="80" width="100" src="{{asset('noimg.png')}}" alt="no-p_image">    
                                        @endif
                            
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Favicon Image:</b></label>
                        <div class="col-sm-10">
                            <input name="favicon_image" class="form-control" type="file" placeholder="Enter favicon_image...." id="example-text-input" value="{{ !empty($site_settings->favicon_image) ? $site_settings->favicon_image : '' }}">
                            @if ($errors->has('favicon_image'))
                                <span class="text-danger">{{ $errors->first('favicon_image') }}</span>
                            @endif
                        </div>
                    </div>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"><b>Address:</b></label>
                    <div class="col-sm-10">
                        <input name="address" class="form-control" type="text" placeholder="Enter Address...." id="example-text-input" value="{{ $site_settings->address }}">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
            
                <div class="row mb-3">
                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Email</b></label>
                    <div class="col-sm-10">
                        <input name="email" class="form-control" type="email" placeholder="h4l@example.com" id="example-email-input" value="{{ $site_settings->email }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-tel-input" class="col-sm-2 col-form-label"><b>Phone</b></label>
                    <div class="col-sm-10">
                        <input name="phone" class="form-control" type="tel" placeholder="1-(555)-555-5555" id="example-tel-input" value="{{ $site_settings->phone }}">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-url-input" class="col-sm-2 col-form-label"><b>Twitter</b></label>
                    <div class="col-sm-10">
                        <input name="twitter" class="form-control" type="url" placeholder="https://twitter.com/h4l" id="example-url-input" value="{{ $site_settings->twitter }}">
                        @if ($errors->has('twitter'))
                            <span class="text-danger">{{ $errors->first('twitter') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-url-input" class="col-sm-2 col-form-label"><b>Facebook</b></label>
                    <div class="col-sm-10">
                        <input name="facebook" class="form-control" type="url" placeholder="https://facebook.com/h4l" id="example-url-input" value="{{ $site_settings->facebook }}">
                        @if ($errors->has('facebook'))
                            <span class="text-danger">{{ $errors->first('facebook') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-url-input" class="col-sm-2 col-form-label"><b>YouTube</b></label>
                    <div class="col-sm-10">
                        <input name="youtube" class="form-control" type="url" placeholder="https://youtube.com/h4l" id="example-url-input" value="{{ $site_settings->youtube }}">
                        @if ($errors->has('youtube'))
                            <span class="text-danger">{{ $errors->first('youtube') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-url-input" class="col-sm-2 col-form-label"><b>Instagram</b></label>
                    <div class="col-sm-10">
                        <input name="instagram" class="form-control" type="url" placeholder="https://instagram.com/h4l" id="example-url-input" value="{{ $site_settings->instagram }}">
                        @if ($errors->has('instagram'))
                            <span class="text-danger">{{ $errors->first('instagram') }}</span>
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