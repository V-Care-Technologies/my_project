@extends('front.layouts.app')
@section('page_title','Blog')

@section('content')

    <section class="breadcrub_section">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $blogs[0]->title }}</li>
          </ol>
        </nav>
      </div>
    </section> 
  <!-- product category -->
  <section class="my_account">
    <div class="container">
        <div class="row blog_detail_row">
            <div class="blog_box">
                <div class="blog_img">
                    <img src="{{ asset('storage/app/public/media/blog/' . $blogs[0]->image) }}" >
                </div>
                <div class="blog_text">
                    <div class="date_row">
                        <div class="">
                            <div class="calender_icon">
                                <!--<img src="{{ asset('public/front/images/calender.svg') }}"-->
                                <!--    class="calender_img">-->
                            </div>
                            <span>{{ date('d M,Y',strtotime($blogs[0]->created_at)) }}</span>
                        </div>
                        <div class="">
                            <div class="calender_icon">
                                <!--<img src="{{ asset('public/front/images/blog_user.svg') }}"-->
                                <!--    class="blog_user">-->
                            </div>
                           
                        </div>
                    </div>
                    <div class="blog_content">
                        <h5>{{ $blogs[0]->title }}</h5>
                        <p>{{ $blogs[0]->desc }}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<section class="other_blogs">
    <div class="container"> 
        <div class="main_heading">
            <h4>Other Blogs</h4>
        </div>
        <div class="row">
            <div class="blog-detail-swiper">
                <div class="swiper-wrapper">
                    @foreach ($related_blog as $list)
                        <div class="swiper-slide">
                            <div class="blog_box">
                                <div class="blog_img">
                                    <img src="{{ asset('storage/app/public/media/blog/' . $list->image) }}"
                                        class="blog_img">
                                </div>
                                <div class="blog_text">
                                    <div class="date_row">
                                        <div class="">
                                            <div class="calender_icon">
                                                <!--<img src="{{ asset('public/front/images/calender.svg') }}"-->
                                                <!--    class="calender_img">-->
                                            </div>
                                            <span>{{ date('d M,Y',strtotime($list->created_at)) }}</span>
                                        </div>
                                        <div class="">
                                            <div class="calender_icon">
                                                <!--<img src="{{ asset('public/front/images/blog_user.svg') }}"-->
                                                <!--    class="blog_user">-->
                                            </div>
                                            <!--<span>Names</span>-->
                                        </div>
                                    </div>
                                    <div class="blog_content">
                                        <h5>{{ $list->title }}</h5>
                                        <p>{{ $list->desc }}</p>
                                    </div>
                                    <div class="read_btn">
                                        <a href="{{ url('blog/'.$list->alias) }}">Read More <i class="fa-solid fa-arrow-right fa-fade"
                                                style="color: #b23632;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
               <div class="swiper-button-prev10">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="swiper-button-next10">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div> 
        </div>
    </div>
</section>
@endsection