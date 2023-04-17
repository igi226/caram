@extends('User.Master.main')
@section('content')
<section class="caramia_media_signup">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1">
                <div class="caramia_signup_heading">
                    <h3>Register to Join the Contest</h3>
                </div>
                <div class="caramia-signup">
                    <form action="{{ route("userUploadVideo") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="caramia-signup_form">
                            <label for="title" class="form-label">Title: <span class="text-danger">*</span></label>
                            <div class="caramia_radio_box">
                                <input value="Mr." type="radio" id="" name="title" checked>
                                <label for="" >Mr.</label>
                                <input value="Ms." type="radio" id="" name="title">
                                <label for="">Ms.</label>
                                <input value="Mrs." type="radio" id="" name="title">
                                <label for="">Mrs.</label>
                            </div>
                            
                        </div>
                        @if ($errors->has('title'))

                            <span class="text-danger text-center">{{ $errors->first('title') }}</span><br>

                            @endif
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Family Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Family Name" name="family_name" value="{{ old("family_name") }}" required>
                                
                        </div>
                        @if ($errors->has('family_name'))

                                <span class="text-danger">{{ $errors->first('family_name') }}</span><br>

                                @endif
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Name <span class="text-danger">*</span> </label>
                            <input value="{{ old("name") }}" type="text" class="form-control" placeholder="Name" name="name" required>
                           
                        </div>
                        @if ($errors->has('name'))

                        <span class="text-danger">{{ $errors->first('name') }}</span><br>

                        @endif
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old("email") }}" required>
                            
                        </div>
                        @if ($errors->has('email'))

                                <span class="text-danger">{{ $errors->first('email') }}</span><br>

                                @endif

                                <div class="caramia-signup_form">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    
                                </div>
                                @if ($errors->has('image'))
        
                                        <span class="text-danger">{{ $errors->first('image') }}</span><br>
        
                                        @endif
                                


                        {{-- <div class="caramia-signup_form">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="userpassword" >
                            {{-- <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                            {{-- <span class="field-icon toggle-password" onclick="password_show_hide();">
                                <i class="fa fa-fw fa-eye" id="show_eye"></i>
                                <i class="fa fa-eye-slash d-none" aria-hidden="true" id="hide_eye"></i>
                            </span>
                        </div>
                        @if ($errors->has('password'))

                                <span class="text-danger">{{ $errors->first('password') }}</span><br>

                                @endif  --}}
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date"  class="form-control"  name="dob" value="{{ old("dob") }}">
                            
                        </div>
                        @if ($errors->has('dob'))

                                <span class="text-danger">{{ $errors->first('dob') }}</span>

                                @endif
                        {{-- @php
                            $contest = DB::table("contests")->where('end_dt','>', now())->get();
                        @endphp
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Contest</label>
                            <select name="contest_id" class="form-control">
                                @foreach ($contest as $item)
                                <option value="{{ $item->id }}">{{ $item->contest_name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" placeholder="Email" name="email"> --}}
                            
                        {{-- </div>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif --}}
                        <input type="hidden" name="contest_id" value="{{ $contests->id }}">
                        <div class="caramia-signup_form">
                            <label for="" class="form-label">Contest</label>
                            <input class="form-control" value="{{ $contests->contest_name }}" disabled>
                            
                        </div>
                        <div class="caramia-signup_form caramia-checkbox">
                            
                            <input type="checkbox" class="larger" name="termsAccept" @if ('checked')

                            value="1"
   
                            @else
   
                            value="0" @endif>
                            <span class="text-danger">*</span>
                            <label for="">I have agreed to the <a target="_blank" href="{{ route("terms") }}">Terms & Conditions</a> and <a target="_blank" href="{{ route("privacyPolicy") }}">Privacy Policy</a></label>
                        </div>
                        @if ($errors->has('termsAccept'))

                                <span class="text-danger">{{ $errors->first('termsAccept') }}</span>

                                @endif
                        <div class="text-center media_form_btn mt-5">
                            <button type="submit" class="btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
