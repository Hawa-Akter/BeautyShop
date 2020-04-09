@extends('frontEnd.master')
@section('title')
    Beauty Shop|Market Cart
@endsection
@section('content')

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Cart</span>
                        <h2 class="entry-title">Your Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('messageDanger'))
        <div style="text-align: center" class="alert alert-danger">
            {{ Session::get('messageDanger') }}
        </div>
    @endif

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="header text-center">
                    <h3 class="small-title">Beauty Shop cart</h3>
                    <p>Shopping from Beauty shop Market Place</p>
                </div>
                <div class="col-md-12">
                    <div class="wishlist">
                        <div class="col-md-4 col-sm-4 text-center">
                            <p>Product</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Price</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Quantity</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Total</p>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <p>Close</p>
                        </div>
                    </div>
                </div>
                @foreach($allCartProduct as $item)
                    <div class="wishlist-entry clearfix">
                        <div class="col-md-4 col-sm-4">
                            <div class="cart-entry">
                                <a class="image" href="#"><img src="{{asset($item->options->productImage)}}" alt=""></a>
                                <div class="cart-content">
                                    <h4 class="title">{{$item->name}}</h4>
                                    <p>{{$item->options->details}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                ৳ {{$item->price}} @if($item->options->discount > 0)<del>৳ {{$item->options->orgPrice}}</del> @else  @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <ul class="quantity-selector">
                                <form method="post" action="{{url('/update-marketCart')}}">
                                    {{csrf_field()}}
                                    <input type="number" min=1 name="qty" class="entry number" value="{{$item->qty}}"/>
                                    <input type="hidden" name="id" class="entry number" value="{{$item->id}}"/>
                                    <input type="hidden" name="rowId" class="entry number" value="{{$item->rowId}}"/>
                                    <input type="submit" value="Update">
                                </form>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <div class="price">
                                {{$item->qty*$item->price}}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 entry">
                            <a class="btn-close" href="{{url('/remove-from-market-cart/'.$item->rowId)}}"><i class="icon-close"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-offset-10 col-md-2">
                    <a href="{{url('/market-checkout-content')}}" class="btn btn-common">Checkout</a>
                </div>
            </div>
        </div>
    </div>


@endsection