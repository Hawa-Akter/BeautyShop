@extends('frontEnd.master')

@section('title')
    Ecommerce|Beautitian
    @endsection

@section('content')


    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Beautitian</span>
                        <h2 class="entry-title">Beautitian</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="team section">
        <div class="container">
            <h1 class="section-title">Top Beautitian</h1>
            <div class="row">
                @foreach($beautitian as $item)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="team-item">
                        <figure>
                            <img src="{{asset($item->photo)}}" height="440px" width="360px" alt="">
                            <figcaption>
                                <div class="info">
                                   <a href="{{url('/profile-details/'.$item->user_id)}}"><h3>{{$item->name}}</h3></a>
                                    <p>{{$item->profession}}</p>
                                </div>
                                <div class="social">
                                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                    <div class="my-rating-12" data-rating="{{$obj->AvgBeautitianRate($item->user_id)}}"></div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <div class="testimonial section">
        <div class="container">
            <div class="row">

                <div class="testimonials-carousel owl-carousel">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author-info">
                                <a href="#"><img src="assets/img/testimonial/img1.jpg" alt=""></a>
                                <div class="author-title">
                                    <h5>Jared Erondu</h5>
                                    <span>- CEO & art director</span>
                                </div>
                            </div>
                            <div class="datils">
                                <p>“ Lorem Ipsum is simply dummy text of the printing andypesetting industry. Lorem ipsum a simpleLorem <br> Ipsum has been the industry's standard dummy hic et quidem. Dignissimos ad <br> maxime velit unde inventore quasi vero dolorem.“</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author-info">
                                <a href="#"><img src="assets/img/testimonial/img2.jpg" alt=""></a>
                                <div class="author-title">
                                    <h5>Cadic Vegeta</h5>
                                    <span>- Graphic Design</span>
                                </div>
                            </div>
                            <div class="datils">
                                <p>“ Lorem Ipsum is simply dummy text of the printing andypesetting industry. Lorem ipsum a simpleLorem <br> Ipsum has been the industry's standard dummy hic et quidem. Dignissimos ad <br> maxime velit unde inventore quasi vero dolorem.“</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author-info">
                                <a href="#"><img src="assets/img/testimonial/img3.jpg" alt=""></a>
                                <div class="author-title">
                                    <h5>Jonathan Beri</h5>
                                    <span>- Web Developer</span>
                                </div>
                            </div>
                            <div class="datils">
                                <p>“ Lorem Ipsum is simply dummy text of the printing andypesetting industry. Lorem ipsum a simpleLorem <br> Ipsum has been the industry's standard dummy hic et quidem. Dignissimos ad <br> maxime velit unde inventore quasi vero dolorem.“</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="support section">
        <div class="container">
            <div class="row">
                <div class="support-inner">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-plane"></i>
                                    Free Shipping Worldwide
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-earphones-alt"></i>
                                    24/7 Customer Service
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row-normal clearfix">
                            <div class="support-info">
                                <div class="info-title">
                                    <i class="icon-heart"></i>
                                    Member Discount
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection