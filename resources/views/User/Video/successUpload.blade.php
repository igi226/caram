
@extends('User.Master.main')
@section('content')
<section class="video-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="successfully-video">
                    <img src="{{ asset('user-asset/assets/images/success-icon.png') }}" alt="">
                    <div class="success-content">
                        <h3>You have Successfully submitted your video to us.</h3>
                        <p>
                            We will reveal the Name of the winners soon on our Winner Page;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection