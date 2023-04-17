@extends('User.Master.main')
@section('content')
    <section class="video-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="{{ url('upload-video-post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="caramia-upload-video">

                            <div class="" id="video-upload-preview">
                                <img src="{{ asset('user-asset/assets/images/upload-video-icon.png') }}" alt="">
                            </div>
                            <div class="d-none" id="video-upload-caramia">
                                <video id="video" width="100%" height="300" controls></video>
                            </div>
                            <div class="video-file" id="video-div">
                                <input type="file" name="v_video" id="file-input" accept="video/*" hidden required />
                                @if ($errors->has('v_video'))
                                    <span class="text-danger">{{ $errors->first('v_video') }}</span>
                                @endif
                            </div>
                            <label for="file-input" class="choose-file-video">CHOOSE FILE TO UPLAOD</label><br><br>
                            <input type="hidden" name="user_id" value="{{ $register->id }}">
                            <input type="hidden" name="contest_id" value="{{ $contest_id }}">
                            <div>
                                <input placeholder="Enter Video name" type="text" name="v_name" class="form-control">
                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <button type="submit" class="video-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
