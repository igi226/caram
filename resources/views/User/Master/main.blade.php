<?php

    $site_info = DB::table("site_settings")->where("slug", "caramia-slug")->select("logo_image", "favicon_image","twitter","facebook","instagram","youtube")->first();

?>
<html>

<head>
    <title>Caramia Media</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('user-asset/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user-asset/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('user-asset/assets/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('user-asset/assets/css/style.css')}}">


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/SiteImages/' . $site_info->favicon_image) }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
    
    <header class="header-menu" id="navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-10 col-9 ">
                    <div class="logo">
                        <a href="{{ route("index") }}"><img src="{{ asset('storage/SiteImages/' . $site_info->logo_image) }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-2 col-3">
                    <div class="main-menu">
                        <div class="header-menu-list">
                            <ul>
                                <li>
                                    <a href="{{ route('getWinners') }}">Winners</a>
                                </li>
                                <li>
                                    <a href="{{ route('aboutUs') }}">About us</a>
                                </li>
                            </ul>

                        </div>
                        {{-- <div class="header-register">
                            <a href="">Register</a>
                        </div> --}}
                    </div>

                    <div class="right-menu-side">
                        <div id="mySidenav" class="sidenav">
                            <div class="closebtn">
                                <a href="javascript:void(0)" onclick="closeNav()">&times;</a>
                            </div>
                            <div class="logo">
                                <a href="{{ route("index") }}"><img src="{{ asset('user-asset/assets/images/logo-caramia.png') }}" alt=""></a>
                            </div>
                            <a href="{{ route('getWinners') }}">Winners</a>
                            <a href="{{ route('aboutUs') }}">About us</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="">
        <div class="footer-area">
            <div class="footer-logo">
                <img src="{{ asset('user-asset/assets/images/logo-caramia.png') }}" alt="">
            </div>
            <div class="footer-link">
                <ul>
                    <li>
                        <a href="{{ route('getWinners') }}">Winners</a>
                    </li>
                    <li>
                        <a href="{{ route('aboutUs') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('contactUs') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
            
            <div class="footer-social">
                <a href="{{ $site_info->facebook ?? "#" }}"><i class="fa fa-facebook-f"></i></a>
                <a href="{{ $site_info->twitter ?? "#" }}"><i class="fa fa-twitter"></i></a>
                <a href="{{ $site_info->instagram ?? "#" }}"><i class="fa fa-instagram"></i></a>
                <a href="{{ $site_info->youtube ?? "#" }}"><i class="fa fa-youtube-play"></i></a>
                {{-- <a href="{{ $site_info->facebook ?? "#" }}"><i class="fa fa-linkedin"></i></a> --}}
            </div>
        </div>
        <div class="footer-copyright">
            <div class="copyright-content">
                <p>&#169; @php
                    echo date("Y");
                @endphp  All Rights Reserved Caramia Media LLC.</p>
            </div>
            <div class="footer-uses">
                <a href="{{ route("terms") }}">Terms of Use</a>
                <span>|</span>
                <a href="{{ route("privacyPolicy") }}">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('user-asset/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user-asset/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-asset/assets/js/slick.min.js') }}"></script>

    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
<script>
    function password_show_hide() {
var x = document.getElementById("userpassword");
var show_eye = document.getElementById("show_eye");
var hide_eye = document.getElementById("hide_eye");
hide_eye.classList.remove("d-none");
if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
} else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
}
}
</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    const input = document.getElementById("file-input");
    const video = document.getElementById("video");
    const videoSource = document.createElement("source");
    input.addEventListener("change", function() {
        const files = this.files || [];
        if (!files.length) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            videoSource.setAttribute("src", e.target.result);
            video.appendChild(videoSource);
            video.load();
            video.play();
        };
        reader.onprogress = function(e) {
            console.log("progress: ", Math.round((e.loaded * 100) / e.total));
        };
        reader.readAsDataURL(files[0]);
        //Show hide div
        $('#video-upload-preview').addClass('d-none');
        $('#video-upload-caramia').removeClass('d-none');
        $('#video-div').addClass('d-none');
        $('#change-video').removeClass('d-none')
    });
</script>
<script>
   $(function () {
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
    });
});

</script>
<script>
    "use strict";
// Class definition

var KTMaskDemo = function () {

    // private functions
    var demos = function () {
        $('#datepicker').mask('00-00-0000', {
            placeholder: "mm-dd-yyyy"
        });

        
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTMaskDemo.init();
});
</script>

<script>
    $('.media-slider').slick({
  dots: false,
  infinite: false,
  speed: 1000,
  slidesToShow: 3,
  margin: 10,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
</body>

</html>