@extends('frontEnd.master')

@section('title')
    BeautyShop | Products
    @endsection

@section('content')


<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <a href="#"><i class="icon-home"></i> Home</a>
                    <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                    <span class="current">Shop Categories</span>
                    <h2 class="entry-title">Shop Categories</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="content" class="product-area">
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="widget-search md-30">
                    <form action="#">
                        <input class="form-control" placeholder="Search here..." type="text">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="widget-ct widget-categories mb-30">
                    <div class="widget-s-title">
                        <h4>Categories</h4>
                    </div>
                    <ul id="accordion-category" class="product-cat">
                        @foreach($categories as $category)
                        <li class="panel">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-{{$category->slug}}" href="#{{$category->slug}}">{{$category->category_name}}<span><i class="icon-arrow-down"></i></span></a>
                            <div id="{{$category->slug}}" class="panel-collapse collapse">
                                <ul class="listSidebar">
                                    @foreach($category->NavigationSubCategory as $subCategory)
                                    <li><a href="{{url('/category/'.$category->slug.'/'.$subCategory->slug)}}">{{$subCategory->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endforeach

                        <li><a href="#" class="pr-all">Product All</a></li>
                    </ul>
                </div>
                <div class="widget-ct widget-color mb-30">
                    <div class="widget-s-title">
                        <h4>Brand</h4>
                    </div>
                    <div class="widget-info color-filter clearfix">
                        <ul>
                            @foreach($allBrands as $allBrand)
                            <li><a href="{{url('/brand/'.$allBrand->slug)}}"><span class="color color-1"></span>{{$allBrand->brand_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="widget-ct widget-filter mb-30">
                    <div class="widget-s-title">
                        <h4>Filter By Price</h4>
                    </div>

                    <div class="widget-info filter-price" style="position: relative;">
                        <form action="{{url('/search-by-range')}}" method="get">
                        <div>
                            <input type="text" id="range" value="" name="range" />
                        </div>
                        <div class="filter-btn">
                            <button class="btn btn-common" type="submit">Filter</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="widget-ct widget-banner">
                    <div class="widget-info widget-banner-img">
                        <a href="#"><img src="assets/img/banner-left.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="shop-content">
                    <div class="col-md-12">
                        <div class="product-option mb-30 clearfix">
                            <ul class="shop-tab">
                                <li class="active"><a aria-expanded="true" href="#grid-view" data-toggle="tab"><i class="icon-grid"></i></a></li>
                                <li><a aria-expanded="false" href="#list-view" data-toggle="tab"><i class="icon-list"></i></a></li>
                            </ul>

                            <div class="showing text-right">
                                <p class="hidden-xs">Showing 01-09 of 17 Results</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane active">
                            @foreach($allProducts as $allProduct)

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="shop-product">
                                    <div class="product-box">
                                        <a href="{{url('/product-details/'.$allProduct->slug)}}"><img src="{{asset($allProduct->productImage)}}" height="252px" width="252px" alt=""></a>
                                        <div class="cart-overlay">
                                        </div>
                                        <span class="sticker new"><strong>NEW</strong></span>
                                        <div class="actions">
                                            <div class="add-to-links">
                                                @if(isset(Auth::user()->role)&& Auth::user()->role=="admin")
                                                  @else
                                                <a href="{{url('/add-to-cart/'.$allProduct->slug)}}" class="btn-cart"><i class="icon-basket-loaded"></i></a>
                                                @endif
                                                    <a href="{{url('/add-to-wishlist/'.$allProduct->id)}}" class="btn-wish"><i class="icon-heart"></i></a>
                                                <a onclick="addtoCompare('{{$allProduct->slug}}')" class="btn-cart"><i class="icon-chart"></i></a>
                                                <a class="btn-quickview md-trigger" data-modal="modal-{{$allProduct->id}}"><i class="icon-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="{{url('/product-details/'.$allProduct->slug)}}">{{$allProduct->productName}}</a></h4>
                                        <div class="align-items">
                                            <div class="pull-left">
                                                <span class="price"> ‎৳ {{$allProduct->productPrice-$allProduct->productPrice*$allProduct->discount/100}}</span>
                                                @if($allProduct->discount>0)
                                                    <span class="old-price font-14px ml-10" style="color: red"><del> ‎৳ {{$allProduct->productPrice}}</del></span>
                                                @endif
                                            </div>
                                            <div class="pull-right">
                                                <div class="reviews-icon">
                                                    <div class="my-rating-5" data-rating="{{$allProduct->AvgRate($allProduct->slug)}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="md-modal md-effect-3" id="modal-{{$allProduct->id}}">
                                    <div class="md-content">

                                        <div class="product-info row">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="product-details-image">
                                                    <div class="slider-for slider">
                                                        <div>
                                                            <img src="{{$allProduct->productImage}}" alt="">
                                                        </div>
                                                        @foreach($avgRatings->productImages($allProduct->id) as $image)
                                                        <div>
                                                            <img src="{{$image->image_name}}" alt="">
                                                        </div>
                                                            @endforeach
                                                    </div>
                                                    <ul id="productthumbnail" class="slider slider-nav">
                                                        <li>
                                                            <img src="{{$allProduct->productImage}}" alt="">
                                                        </li>
                                                        @foreach($avgRatings->productImages($allProduct->id) as $image)
                                                        <li>
                                                            <img src="{{$image->image_name}}" alt="">
                                                        </li>
                                                            @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <div class="info-panel">
                                                    <h1 class="product-title">{{$allProduct->productName}}</h1>

                                                    <div class="price-ratting">
                                                        <div class="price float-left">
                                                            {{$allProduct->productPrice}}
                                                        </div>
                                                        <div class="ratting float-right">
                                                            <div class="product-star">
                                                                <div class="my-rating-5" data-rating="{{$allProduct->AvgRate($allProduct->slug)}}"></div>
                                                                <span>(01 Customer Review)</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="short-desc">
                                                        <h5 class="sub-title">Product Overview</h5>
                                                        <p>{{$allProduct->productDetails}}</p>
                                                    </div>

                                                    <div class="product-size">
                                                        <h5 class="sub-title">Available Quantity</h5>
                                                        <span>{{$allProduct->quantity}}</span>

                                                    </div>

                                                    <div class="quantity-cart">
                                                        @if(isset(Auth::user()->role)&& Auth::user()->role=="admin")

                                                            @else

                                                        <a  href="{{url('/add-to-cart/'.$allProduct->slug)}}" class="btn btn-common"><i class="icon-basket-loaded"></i> add to cart</a>

                                                   @endif
                                                    </div>

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

                                        <button class="md-close"><i class="icon-close"></i></button>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div id="list-view" class="tab-pane">
                            <div class="shop-list">
                                @foreach($allProducts as $allProduct)
                                <div class="col-md-12">
                                    <div class="shop-product clearfix">
                                        <div class="product-box">
                                            <a href="{{url('/product-details/'.$allProduct->slug)}}"><img src="{{asset($allProduct->productImage)}}" height="239px" width="239px" alt=""></a>
                                            <div class="cart-overlay">
                                            </div>
                                            <div class="actions">
                                                <div class="add-to-links">
                                                    @if(isset(Auth::user()->role)&& Auth::user()->role=="admin")
                                                   @else

                                                    <a href="{{url('/add-to-cart/'.$allProduct->slug)}}" class="btn-cart"><i class="icon-basket-loaded"></i></a>
                                                   @endif
                                                    <a href="{{url('/add-to-wishlist/'.$allProduct->id)}}" class="btn-wish"><i class="icon-heart"></i></a>
                                                    <a class="btn-quickview md-trigger" data-modal="modal-{{$allProduct->id}}"><i class="icon-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="fix">
                                                <h4 class="product-title pull-left"><a href="{{url('/product-details/'.$allProduct->slug)}}">{{$allProduct->productName}}</a></h4>
                                                <div class="star-rating pull-right">
                                                    <div class="reviews-icon">
                                                        <i class="i-color fa fa-star"></i>
                                                        <i class="i-color fa fa-star"></i>
                                                        <i class="i-color fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fix mb-10">
                                                <span class="price"> ‎৳ {{$allProduct->productPrice-($allProduct->discount*$allProduct->productPrice/100)}}</span>
                                                @if($allProduct->discount>0)
                                                <span class="old-price font-16px ml-10"><del> ‎৳ {{$allProduct->productPrice}}</del></span>
                                                    @endif
                                            </div>
                                            <div class="product-description mb-20">
                                                <p>{{$allProduct->productDetails}}</p>
                                            </div>
                                            <a href="{{url('/add-to-wishlist/'.$allProduct->id)}}"><button class="btn btn-common"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to wishlist</button></a>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination">
                    <div class="results-navigation pull-left">
                        Showing: 1 - 6 Of 17
                    </div>
                    <nav class="navigation pull-right">
                        <a class="next-page" href="#"><i class="fa fa-angle-left"></i></a>
                        <span class="current page-num">1</span>
                        <a class="page-num" href="#">2</a>
                        <a class="page-num" href="#">3</a>
                        <div class="divider">...</div>
                        <a class="next-page" href="#"><i class="fa fa-angle-right"></i></a>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="md-overlay"></div>


<script>
    function addtoCompare(slug){

        $.ajax({
            type: 'POST',
            url: '{{url('/add-my-compare')}}',
            data: {slug:slug,"_token":"{{csrf_token()}}"},

        }).done(function( msg ) {
            console.log(msg);


        });
    }


</script>

@endsection