@extends('frontEnd.master')

@section('title')
    BeautyShop|Wishlist
    @endsection

@section('content')

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Wishlist</span>
                        <h2 class="entry-title">Wishlist</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Wishlist</h3>
                </div>
                <h4 style="text-align: center" class="text-info">{{ Session::get('mess') }}</h4>

                <div class="col-md-12">
                    <div class="wishlist">
                        <div class="col-md-4 col-sm-4 text-center">
                            <p>Product</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Price</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Stock status</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Add to cart</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Close</p>
                        </div>
                    </div>
                    @foreach($allitems as $allitem)
                    <div class="wishlist-entry clearfix">
                        <div class="col-md-4 col-sm-4">
                            <div class="cart-entry">
                                <a class="image" href="#"><img src="{{asset($allitem->options->productImage)}}" alt=""></a>
                                <div class="cart-content">
                                    <h4 class="title">{{$allitem->name}}</h4>
                                    <p>{{$allitem->options->details}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{$allitem->price}} <del>{{$allitem->options->orgPrice}} </del>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            @if($allitem->qty>0)
                            <a class="instock" href="#">In stock</a>
                                @else

                                <a class="stock" href="#">Out of stock</a>
                            @endif
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn btn-common " href="{{url('/add-to-cart/'.$allitem->options->slug)}}">
                                <i class="icon-basket-loaded"></i> add to Cart
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn-close" href="{{url('/del-wishlist/'.$allitem->id.'/'.$allitem->rowId)}}"><i class="icon-close"></i></a>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection