@extends('User.Master.main')
@section('content')
<section>
    <div class="media-banner">
        <video autoplay muted loop id="myVideo">
            @if (isset($home2->video) && !empty($home2->video) && File::exists(public_path('storage/CmsImage/' . $home2->video)))
            <source src="{{ asset('storage/CmsImage/'. $home2->video ) }}" type="video/mp4">
            @else
            <source src="{{ asset('user-asset/assets/images/banner-video.mp4') }}" type="video/mp4">
            @endif
            
        </video>
        <div class="media-banner-content">
            <div class="banner-content">
                <div class="banner-content-area">
                    <h1>{{ $home1->title }}</h1>
                    <h3>{{ $home1->short_desc }}</h3>
                    <h3><?php echo html_entity_decode($home1->description );?></h3>
                    <div class="media-tango">
                        @foreach ($contests_latest as $contest)
                        <div class="media-tango-teacher">
                            <h3>{{ $contest->contest_name }}</h3>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="media-slider">
            @foreach ($contests as $con)
                
            
            <div>
                <div class="caramia-teacher">
                    <h3>{{ $con->contest_name }}</h3>
                    @php
                        $desc =  strip_tags($con->contest_description );
                      
                        $explode = explode(",", $desc);
                    @endphp
                    @foreach ($explode as $prize)
                    <p>{{ html_entity_decode($prize) }}</p>
                    @endforeach
                    <div class="caramia-register">
                        <a href="{{ route("registerForVideo", $con->id) }}">Register</a>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div>
                <div class="caramia-teacher">
                    <h3>Tango Teacher<br> Blog Contest</h3>
                    <p>Grand Prize $2000 (USD)</p>
                    <p>Runner up $250 (USD)</p>
                    <div class="caramia-register">
                        <a href="{{ route("registerForVideo") }}">Register</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="caramia-teacher">
                    <h3>Tango Teacher<br> Inspiration Video Contest</h3>
                    <p>Grand Prize $2000 (USD)</p>
                    <p>Runner up $250 (USD)</p>
                    <div class="caramia-register">
                        <a href="{{ route("registerForVideo") }}">Register</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="caramia-teacher">
                    <h3>Tango Teacher<br> Inspiration Video Contest</h3>
                    <p>Grand Prize $2000 (USD)</p>
                    <p>Runner up $250 (USD)</p>
                    <div class="caramia-register">
                        <a href="{{ route("registerForVideo") }}">Register</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<section class="mt-5 video-contest">
    <div class="container">
        <div class="row align-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-content">
                    <h3>Tango Teacher Video Contest</h3>
                    <ul>
                        <li>Produce a 5-8 min Video Demonstrating how to dance a Tango form or concept.</li>
                        <li>Video must be performed in English.</li>
                        <li>Entrant must be 18 years of age or older as of January 9th, 2023.</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-video">
                    <img src="{{ asset('user-asset/assets/images/video-contest-02.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity1.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Record Your Dance</b>
                        <p>All you need is a device to record your Video Demonstrating how to dance a Tango Form or Concept. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity2.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Send it to us</b>
                        <p>We have got the platform that you are looking for. Send your recorded video to us where you are showing us your best tango instructing skills.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity3.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Wait for our results</b>
                        <p>Wait to see if you are selected as one of the 10 Finalist on March 1st, 2023 and listed on the winners page. The Grand Prize Winners and 1st Runner up will be awarded on March 20th, 2023.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5 video-contest">
    <div class="container">
        <div class="row align-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-content">
                    <h3>Tango Teacher Blog Contest</h3>
                    <ul>
                        <li>Write a 1000-1500 word Blog post</li>
                        <li>Article can be about anything that has to do with Tango Teaching and Dancing.</li>
                        <li>Entrant must be 18 years of age or older as of January 9th, 2023.</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-video">
                    <img src="{{ asset('user-asset/assets/images/blog-01.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity4.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Write a Blog</b>
                        <p>Write a Blog about your choice and knowledge about Tango, that can be anything related to Tango.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity2.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Send it to us</b>
                        <p>We have got the platform that you are looking for. Send your typed blog that showcases your knowledge of teaching tango or interesting stories related to Tango dancing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity3.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Wait for our results</b>
                        <p>Wait to see if you are selected as one of the 10 Finalist on March 1st, 2023 and listed on the winners page. The Grand Prize Winners and 1st Runner up will be awarded on March 20th, 2023.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5 video-contest">
    <div class="container">
        <div class="row align-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-content">
                    <h3>Tango Teacher Inspirational Video</h3>
                    <ul>
                        <li>Produce a 5-8 min Video in Interview style of which Tango Teacher inspired  you to teach Tango and what inpires you about Tango dancing in general</li>
                        <li>Video must be performed in English.</li>
                        <li>Entrant must be 18 years of age or older as of January 9th, 2023.</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="video-contest-video">
                    <img src="{{ asset('user-asset/assets/images/inspiration-01.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity5.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        Record your video
                        <p>Record a 5-8 min Video in Interview style of which Tango Teacher inspired  you to teach Tango and what inspires  you about Tango dancing in general.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity2.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Send it to us</b>
                        <p>We have got the platform that you are looking for. Send your recorded video to us where you express who influenced you to teach Tango. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="media-activity">
                    <div class="activity-top">
                        <img src="{{ asset('user-asset/assets/images/activity3.png') }}" alt="">
                    </div>
                    <div class="activity-content">
                        <b>Wait for our results</b>
                        <p>Wait to see if you are selected as one of the 10 Finalist on March 1st, 2023 and listed on the winners page. The Grand Prize Winners and 1st Runner up will be awarded on March 20th, 2023.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection