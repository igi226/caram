
@extends('User.Master.main')
@section('content')
 <section>
    <div class="top-banner-caramia">
        <div class="top_banner-bg">
            <h2>CONTACT US</h2>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="caramia_about_content">
            <p>Caramia Media is always here to support the Dance Community and bringing new talent in upfront. We are happy to help you with your queries and question, please drop your message and we will get back to your as soon as possible.</p>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-6 mt-5">
                @if(Session::has('msg'))

                <p class="alert alert-info">{{ Session::get('msg') }}</p>

                @endif
                <form action="{{ route("contactForm") }}" method="post">
                    @csrf
                    <div class="contact-form">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))

                            <span class="text-danger">{{ $errors->first('name') }}</span>

                        @endif
                    </div>
                    <div class="contact-form">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))

                            <span class="text-danger">{{ $errors->first('email') }}</span>

                        @endif
                    </div>
                    <div class="contact-form">
                        <label for="" class="form-label">Message</label>
                        <textarea name="message" class="form-control" placeholder="Message" cols="30" value="{{ old('message') }}"></textarea>
                        @if ($errors->has('message'))

                            <span class="text-danger">{{ $errors->first('message') }}</span>

                        @endif
                    </div>
                    <div class="contact-form-btn text-center">
                        <button type="submit" class="btn">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6 mt-5">
                <div class="contact-follow">
                    <ul>
                        <li><span><img src="{{ asset('user-asset/assets/images/envelope-icon.png') }}" alt=""></span> info@caramiamedia.com</li>
                        <li><span><img src="{{ asset('user-asset/assets/images/phone-icon.png') }}" alt=""></span> +44 987-654-3210, +44 987-654-3210,</li>
                        <li><span><img src="{{ asset('user-asset/assets/images/home-icon.png') }}" alt=""></span> 23 Caramia House, Palm Avenue, Miami, FL-32145</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection