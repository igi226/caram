@extends('User.Master.main')
@section('content')


<section>
    <div class="top-banner-caramia">
        <div class="top_banner-bg">
            <h2>Privacy Policy</h2>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="caramia_about_content">
            <p> <?php echo html_entity_decode($privacyPolicy);?></p>
        </div>
    </div>
</section>
@endsection