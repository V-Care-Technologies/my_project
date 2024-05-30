@extends('front.layouts.app')
@section('page_title','About Us')

@section('content')
<section class="breadcrub_section">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About Us</li>
      </ol>
    </nav>
  </div>
</section> 
<section class="about_section">
    <div class="container">
        <div class="row about_row">
            <!--<img src="{{ asset('public/front/images/about_shape.svg')}}" class="about_shape">-->
            
            <div class="col-lg-8 col-12">
                <div class="about_text">
                    <h2 class="about_heading">About Us</h2>
                    <p>Welcome to MYTS Store, your premier destination in the UAE for top-quality playground equipment, indoor or outdoor toys and ride-on products! Nestled in the heart of the Emirates, MYTS Store has blossomed from a modest seed into a flourishing haven for families seeking top-quality ride-ons and play area toys for their little ones.
Our story is one fuelled by passion and commitment to meeting the demands of parents and children alike across the UAE. With a keen focus on safety, innovation, and quality, we've curated a diverse collection of ride-ons that cater to the adventurous spirits of children while providing peace of mind to parents.
From electric ride-ons to scooters, outdoor playground playsets to indoor rockers, trampolines to above ground pools, Kids furniture to Licensed products, Big or small Inflatable bouncer to Bicycles , Offroad ATV Quad Bikes to Electric Bikes , Soft play to Seesaws , Playhouses to manual push Rideons , MYTS Store offers a comprehensive range of products designed to inspire imagination and encourage active play. Each item in our catalog is meticulously selected to ensure maximum fun and development for children of all ages.
But we're more than just a store—we're a trusted partner in your parenting journey. Our team of experienced specialists is here to provide guidance and support every step of the way, helping you navigate the challenges and triumphs of raising happy, healthy children.
So whether you're searching for the perfect outdoor adventure or seeking indoor entertainment on rainy or sunny days, MYTS Store has you covered. Come explore our selection of ride-on products and embark on an unforgettable journey of fun and discovery with your little ones.</p>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="logo_box">
                    <img src="{{ asset('public/front/images/big_logo.png')}}">
                </div>
            </div>
        </div>
    </div>
</section>
   
@endsection