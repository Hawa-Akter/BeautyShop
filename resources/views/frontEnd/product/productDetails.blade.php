@extends('frontEnd.master')
@section('title')

    BeautyShop|Product Details
    @endsection
@section('content')

<section id="product-collection" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-details-image">
                    <div class="slider-for slider">
                        <div>
                            <img src="{{asset($productById->productImage)}}" height="360px" width="360px" alt="">
                        </div>
                        @foreach($collection as $item)
                        <div>
                            <img src="{{asset($item->image_name)}}" height="360px" width="360px" alt="">
                        </div>
                            @endforeach
                    </div>
                    <ul id="productthumbnail" class="slider slider-nav">
                        <li>
                            <img src="{{asset($productById->productImage)}}" width="87px" height="87px" alt="">
                        </li>
                        @foreach($collection as $item)
                        <li>
                            <img src="{{asset($item->image_name)}}" width="87px" height="87px" alt="">
                        </li>
                            @endforeach
                       </ul>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="info-panel">
                    <h1 class="product-title">{{$productById->productName}}</h1>

                    <div class="price-ratting">
                        <div class="price float-left">
                            <span class="price"> ‎৳ {{$productById->productPrice-($productById->discount*$productById->productPrice/100)}}</span>

                        </div>


                    </div>
                    <div class="price-ratting">
                        <div class="price float-left">
                            @if($productById->discount>0)
                                <span class="old-price font-14px ml-10" style="color: red"><del> ‎৳ {{$productById->productPrice}}</del></span>
                            @endif
                        </div>
                        <div class="ratting float-right">
                            <div class="reviews-icon">
                                <div class="my-rating-4" data-rating="{{$avgStar}}"></div>
                                <span>({{$avgStar}})</span>
                            </div>
                        </div>

                    </div>

                    <div class="short-desc">
                        <h5 class="sub-title">Product Details</h5>
                        <p>{{$productById->productDetails}}</p>
                    </div>

                    <div class="quantity-cart">
                        @if(isset(Auth::user()->role)&& Auth::user()->role=="admin")
                       @else
                        <a href="{{url('/add-to-cart/'.$productById->slug)}}"><button class="btn btn-common"><i class="icon-basket-loaded-loaded"></i> add to cart</button>
                       @endif
                        </a></div>

                    <ul class="usefull-link">
                        <li><a href="{{url('/add-to-compare/'.$productById->slug)}}"><i class="icon-envelope-open"></i> Add to compare</a></li>
                        <li><a href="{{url('/add-to-wishlist/'.$productById->id)}}"><i class="icon-heart"></i> Wishlist</a></li>
                    </ul>

                    <div class="share-icons pull-right">
                        <span>share :</span>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="single-pro-tab section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="single-pro-tab-menu">

                    <ul class="">
                        <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                        <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="pro-tab-info pro-description">
                            <h5 class="small-title">Product Date:<span style="color: #F50057"> {{$productById->created_at}}</span></h5>
                            <h5 class="small-title">Product Avaiable Quantity:<span style="color: #F50057"> {{$productById->quantity}}</span></h5>
                            <h5 class="small-title">Product Serial:<span style="color: #F50057"> {{$productById->productSerial}}</span></h5>
                            <h5 class="small-title">Product Total View:<span style="color: #F50057"><i> {{$productById->view}}</i></span></h5>
                            <h5 class="small-title">Product Discount:<span style="color: #F50057"><i> {{$productById->discount}}%</i></span></h5>

                        </div>
                    </div>
                    <div class="tab-pane" id="reviews">
                        <div class="pro-tab-info pro-reviews">
                            <div class="customer-review">
                                <h3 class="small-title">Customer review</h3>
                                @foreach($productReview as $item)
                                <ul class="product-comments clearfix">

                                    <li class="mb-30">
                                        <div class="pro-reviewer">
                                            <img src="{{asset('/assets/')}}/img/reviewer/user.jpg" alt="">
                                        </div>
                                        <div class="pro-reviewer-comment">
                                            <div class="fix">
                                                <div class="pull-left mbl-center">
                                                    <h5><strong>{{$item->review_title}}</strong></h5>
                                                    <p class="reply-date">{{$item->created_at}}</p>
                                                    <p class="reply-date">{{$item->name}}({{$item->role}})</p>
                                                </div>
                                                <div class="comment-reply pull-right">
                                                    <a href="#review"><i class="fa fa-reply"></i></a>
                                                </div>
                                            </div>
                                            <p>{{$item->detail_review}}  </p>
                                        </div>
                                    </li>

                                </ul>
                                @endforeach
                            </div>
                            <div class="leave-review">
                                <h3 class="small-title">Leave your reviw</h3>
                                <div class="your-rating mb-30">
                                    <p class="mb-10" id="review"><strong>Your Rating</strong></p>
                                     @if($AlreadyRated>0)

                                    You already rated!

                                    @else
                                    <div id="rater-step"></div>
                                    @endif

                                </div>
                                <div class="reply-box">
                                    <form class="form-horizontal" method="post" action="{{url('/submit-review')}}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control"  name="review_title" type="text" placeholder="Title...">
                                                <span style="color: red;">{{ $errors->has('review_title') ? $errors->first('review_title') : ' ' }}</span>
                                                <input class="form-control" name="product_id" type="hidden" value="{{$productById->id}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control input-lg" name="detail_review" rows="4" placeholder="Your review here..."></textarea>
                                                <span style="color: red;">{{ $errors->has('detail_review') ? $errors->first('detail_review') : ' ' }}</span>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="btn btn-common" type="submit" value=" Submit Review"/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('additionalScript')



    <script src="{{asset('rater/')}}/example/index.js?v=2"></script>
    <script src="{{asset('rater/')}}/index.js?v=2"></script>


    <script>
        function onload(event) {

            var myDataService =  {
                rate:function(rating) {
                    return {then:function (callback) {

                        setTimeout(function () {
                            callback((Math.random() * 5));
                        }, 1000);
                    }
                    }
                }
            }


            var starRatingStep = raterJs( {
                starSize:28,
                step:0.5,
                element:document.querySelector("#rater-step"),
                rateCallback:function rateCallback(rating, done) {
                    this.setRating(rating);
//                alert(window.location.pathname);
                    var initial_url=window.location.pathname;
                    var url = initial_url .split( '/' );
                    var product_slug= url[ url.length - 1 ];

                    $.ajax({
                        type: 'POST',
                        url: '{{url('/rating-on-product')}}',
                        data: {UserID:'{{Auth::user()->id}}',ProductSlug:product_slug,rate:rating,"_token":"{{csrf_token()}}"},
                    }).done(function( msg ) {
                        console.log(msg)
                    });
                    $('#rater-step').hide();
                    done();
                }
            });


        }

        window.addEventListener("load", onload, false);
    </script>


@endsection