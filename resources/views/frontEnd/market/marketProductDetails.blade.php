@extends('frontEnd.master')
@section('title')

    BeautyShop|Market Product Details
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

                                <h3 style="text-align: center">Add By </h3><h4>({{$userName->name}})</h4>
                            </div>
                        </div>

                    </div>

                    <div class="short-desc">
                        <h5 class="sub-title">Product Details</h5>
                        <p>{{$productById->productDetails}}</p>
                    </div>

                    <div class="quantity-cart">
                        @if($userName->id!=Auth::user()->id)
                        <a href="{{url('/market-add-to-cart/'.$productById->slug)}}"><button class="btn btn-common"><i class="icon-basket-loaded-loaded"></i> add to cart</button>
                        </a></div>
                    @endif


                    <div class="share-icons pull-right">
                        <span>share :</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=http:localhost/BeautyShop3/public/market-product-details/asdfasd-sadf-sd&display=popup" ><i class="fa fa-facebook"></i><a > share this </a></a>
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
                    </ul>
                </div>

                <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="pro-tab-info pro-description">
                                <h5 class="small-title">Product Date:<span style="color: #F50057"> {{$productById->created_at}}</span></h5>
                                <h5 class="small-title">Product Avaiable Quantity:<span style="color: #F50057"> {{$productById->quantity}}</span></h5>
                                <h5 class="small-title">Product Serial:<span style="color: #F50057"> {{$productById->productSerial}}</span></h5>
                                <h5 class="small-title">Product Owner:<span style="color: #F50057"><i> {{$productById->name}}</i></span></h5>
                                <h5 class="small-title">Product Discount:<span style="color: #F50057"><i> {{$productById->discount}}%</i></span></h5>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
