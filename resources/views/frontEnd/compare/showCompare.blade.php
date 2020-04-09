@extends('frontEnd.master')

@section('title')
    BeautyShop|Compare
@endsection

@section('content')


    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Compare</span>
                        <h2 class="entry-title">Compare Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="entry-heading">
                        <h3 class="text-center">Compare Products</h3>
                    </div>
                    <div class="page-content row">
                        <table class="table table-coomare">
                            <tbody>
                            <tr>

                                <td class="compare-lable">Product Image</td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="text-center">
                                    <a href="#"><img src="{{asset($compareProduct->options->Image)}}" height="200px" width="200px" alt=""></a>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Product Name</td>
                                @foreach($compareProducts as $compareProduct)
                                <td>{{$compareProduct->name}}</td>
                                    @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Rating</td>
                                @foreach($compareProducts as $compareProduct)
                                <td>
                                    <div class="my-rating-4" data-rating="{{$compareProduct->options->star}}"></div>
                                </td>
                                @endforeach
                             </tr>
                            <tr>
                                <td class="compare-lable">Price</td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="price">${{$compareProduct->price}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Discount</td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="price">${{$compareProduct->options->discount}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Discount Price</td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="price">${{$compareProduct->options->discountPrice}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Description</td>
                                @foreach($compareProducts as $compareProduct)
                                <td>
                                    {{$compareProduct->options->Description}}
                                </td>
                                    @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Brand</td>
                                @foreach($compareProducts as $compareProduct)
                                <td>{{$compareProduct->options->Brand}}</td>
                                    @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Availability</td>
                                @foreach($compareProducts as $compareProduct)
                                <td>Out of stock</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Product Serial</td>
                                @foreach($compareProducts as $compareProduct)
                                    <td>{{$compareProduct->options->Code}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Category</td>
                                @foreach($compareProducts as $compareProduct)
                                    <td>{{$compareProduct->options->Category}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Sub-Category</td>
                                @foreach($compareProducts as $compareProduct)
                                    <td>{{$compareProduct->options->subCategory}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="compare-lable">Action</td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="action">
                                    <a href="{{url('/add-to-cart/'.$compareProduct->options->slug)}}" data-original-title="Add to cart" class="add-to-cart-wrap btn btn-common" data-toggle="tooltip" data-placement="top" title="" data-tooltip-added-text="Added to cart">Add to cart</a>
                                    <a href="{{url('/add-to-wishlist/'.$compareProduct->id)}}" data-original-title="Add To Wishlist" class="add-to-cart-wrap btn btn-common" data-toggle="tooltip" data-placement="top" title="" data-tooltip-added-text="Added to cart"><i class="icon-heart"></i></a>
                                    <a href="{{url('/removefromcompare/'.$compareProduct->rowId)}}" data-original-title="Close" class="add-to-cart-wrap btn btn-common" data-toggle="tooltip" data-placement="top" title="" data-tooltip-added-text="Added to cart"><i class="icon-close"></i></a>
                                </td>
                                    @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection