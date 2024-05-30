<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Mytsstore | @yield('page_title')</title>

    @include('front.includes.links')


   
    <meta charset="UTF-8">
</head>

<body>
   @include('front.includes.header')
   <div class="overlay-wrapper">
        <div class="spinner"></div>
    </div>
    <main>
        @yield('content')
        <section class="process_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6" data-aos="fade-up">
                        <div class="process_box">
                            <div class="part_img">
                                <img src="{{ asset('public/front/images/delivery.svg')}}" class="delivery">
                            </div>
                            <div class="part_text">
                                <h4>Express Delivery</h4>
                                <!--<p>Click here for more info</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="process_box">
                            <div class="part_img">
                                <img src="{{ asset('public/front/images/return.svg')}}" class="return">
                            </div>
                            <div class="part_text">
                                <h4>Easy Return</h4>
                                <!--<p>Simply return it within 30 days for an exchange.</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="process_box">
                            <div class="part_img">
                                <img src="{{ asset('public/front/images/payment.svg')}}" class="payment">
                            </div>
                            <div class="part_text">
                                <h4>100% Secure Payment</h4>
                                <!--<p>Shop open from Monday to Sunday</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="process_box">
                            <div class="part_img">
                                <img src="{{ asset('public/front/images/support.svg')}}" class="support">
                            </div>
                            <div class="part_text">
                                <h4>Support 24/7</h4>
                                <!--<p>Contact us 24 hours a day and days a week</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('front.includes.footer')

    @include('front.includes.bottom-links')
    @yield('scripts')
</body>

</html>
