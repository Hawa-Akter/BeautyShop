@extends('frontEnd.master')

@section('title')
    Beauty Shop|Market Checkout
@endsection

@section('content')

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Market-Checkout</span>
                        <h2 class="entry-title">Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
        <div class="container">
            <h3 style="text-align: center" class="text-danger" >{{ Session::get('mess') }}</h3>

            <form action="{{url('/confirm-market-order')}}" method="post" name="shipping" >
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <h2 class="title-checkout"><i class="icon-user"></i>Name & Address</h2>

                        <div class="form-group">
                            <label>First Name <sup>*</sup></label>
                            <input id="name" class="form-control" type="text" disabled value="{{$userInfo->name}}">
                        </div>

                        <div class="form-group">
                            <label>Email Address <sup>*</sup></label>
                            <input id="email" class="form-control" type="email" disabled value="{{$userInfo->email}}">
                        </div>
                        <h2 class="title-checkout"><i class="icon-home"></i>Previous Shipping Address</h2>
                        <div class="form-group">
                            <label>Address 1 <sup>*</sup></label>
                            <input id="add1" class="form-control" disabled value="@if(isset($latestShipping->address1))  {{$latestShipping->address1}} @endif " type="text">
                        </div>
                        <div class="form-group">
                            <input id="add2" class="form-control" disabled value="@if(isset($latestShipping->address2))  {{$latestShipping->address2}} @endif " type="text">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City <sup>*</sup></label>
                                    <input id="city" disabled value="@if(isset($latestShipping->town))  {{$latestShipping->town}} @endif " class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Zip/Postal Code <sup>*</sup></label>
                                    <input id="postCode" disabled class="form-control" value="@if(isset($latestShipping->postCode))  {{$latestShipping->postCode}} @endif " type="text">
                                </div>
                                <div class="form-group">
                                    <label>Telephone <sup>*</sup></label>
                                    <input id="phone" disabled class="form-control" value="@if(isset($latestShipping->phone))  {{$latestShipping->phone}} @endif " type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State/Province <sup>*</sup></label>
                                    <select class="selectpicker" name="sstate" disabled>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Mymensing">Mymensing</option>
                                        <option value="Chottogram">Chottogram</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Khulna">Khulna</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Country <sup>*</sup></label>
                                    <select class="selectpicker" name="scountry" disabled>
                                        <option selected="selected" value="" >Country</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox-group form-group-top clearfix">

                            <label for="checkBox1">
                                <input type="checkbox" onclick="sameFormData()"/>
                                Same Shipping as before
                            </label>
                        </div>


                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <h2 class="title-checkout"><i class="icon-home"></i>Shipping Address</h2>

                        <div class="form-group">
                            <label>First Name <sup>*</sup></label>
                            <input id="nname" class="form-control" name="first_name" type="text">
                            <span style="color: red;">{{ $errors->has('first_name') ? $errors->first('first_name') : ' ' }}</span>
                        </div>

                        <div class="form-group">
                            <label>Email Address <sup>*</sup></label>
                            <input id="nemail" class="form-control" name="email" type="email">

                        </div>
                        <div class="form-group">
                            <label>Address 1 <sup>*</sup></label>
                            <input id="nadd1" class="form-control" name="address1" type="text">
                            <span style="color: red;">{{ $errors->has('address1') ? $errors->first('address1') : ' ' }}</span>
                        </div>
                        <div class="form-group">
                            <input id="nadd2" class="form-control" name="address2" type="text">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City <sup>*</sup></label>
                                    <input id="ntown" class="form-control" name="town" type="text">
                                    <span style="color: red;">{{ $errors->has('town') ? $errors->first('town') : ' ' }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Zip/Postal Code <sup>*</sup></label>
                                    <input id="npostCode" class="form-control" name="postCode" type="text">
                                    <span style="color: red;">{{ $errors->has('postCode') ? $errors->first('postCode') : ' ' }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Telephone <sup>*</sup></label>
                                    <input id="nphone" class="form-control" name="phone" type="text">
                                    <span style="color: red;">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State/Province <sup>*</sup></label>
                                    <select class="selectpicker" name="state" id="state">
                                        <option selected="selected" value="">State</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Mymensing">Mymensing</option>
                                        <option value="Chottogram">Chottogram</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Barishal">Barishal</option>
                                        <option value="Khulna">Khulna</option>
                                    </select>
                                    <span style="color: red;">{{ $errors->has('state') ? $errors->first('state') : ' ' }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Country <sup>*</sup></label>
                                    <select class="selectpicker" name="country">
                                        <option selected="selected" value="">Country</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                    </select>
                                    <span style="color: red;">{{ $errors->has('country') ? $errors->first('country') : ' ' }}</span>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>

                <div class="mb-50"></div>
                <div class="row">


                    <div class="col-md-6 col-sm-6 col-sx-12">
                        <div class="order-details">
                            <h2 class="title-checkout"><i class="icon-basket-loaded-loaded"></i>Your Order</h2>
                            <div class="order_review margin-bottom-35">
                                <table class="table table-responsive table-review-order">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-name">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($checkOutProducts as $checkOutProduct)
                                        <tr>
                                            <td><p>{{$checkOutProduct->name}}</p></td>
                                            <td><p>{{$checkOutProduct->qty}}</p></td>
                                            <td><p class="price" style="text-align: right">{{$checkOutProduct->price}}</p></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td colspan="2">
                                            <p class="price" style="text-align: right">{{$subTotal}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>TAX</th>
                                        <td colspan="2">
                                            <form action="#" class="shipping">
                                                <div class="radio" style="text-align: right">
                                                    <label><strong><span>15%</span></strong></label>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2"><p class="price" style="text-align: right">{{$Total}}</p></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-sx-12">

                        <h2 class="title-checkout">
                            <i class="icon-credit-card"></i>
                            Payment Method
                        </h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <h3 class="text-center">Payment Details</h3>
                                                <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD NUMBER</label>
                                                            <div class="input-group">
                                                                <input type="tel" name="card_number" class="form-control" placeholder="Valid Card Number" />
                                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                            </div>
                                                            <span style="color: red;">{{ $errors->has('card_number') ? $errors->first('card_number') : ' ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                                            <input type="tel" name="ex_date" class="form-control" placeholder="MM / YY" />
                                                            <span style="color: red;">{{ $errors->has('ex_date') ? $errors->first('ex_date') : ' ' }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5 pull-right">
                                                        <div class="form-group">
                                                            <label>CV CODE</label>
                                                            <input type="tel" name="cvc" class="form-control" placeholder="CVC" />
                                                            <span style="color: red;">{{ $errors->has('cvc') ? $errors->first('cvc') : ' ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD OWNER</label>
                                                            <input type="text" name="owner_name" class="form-control" placeholder="Card Owner Names" />
                                                            <span style="color: red;">{{ $errors->has('owner_name') ? $errors->first('owner_name') : ' ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card--padding fill-bg">
                            <input type="submit" class="btn btn-common btn-full" value="Confirm Payment"/>
                        </div>

                    </div>

                </div>
            </form>
            <script>
                document.forms['shipping'].elements['sstate'].value = '@php if(isset($latestShipping->state)){echo $latestShipping->state;}else{ } @endphp';
                document.forms['shipping'].elements['scountry'].value = '@php if(isset($latestShipping->country)){echo $latestShipping->country;}else{ } @endphp';
            </script>
        </div>
    </div>

@endsection