@extends('backend.master')

@section('title')
    Beauty Shop | Order Details
@endsection

@section('content')
    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Orders</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Ecommerce</a></li>
                            <li class="breadcrumb-item active"><span>Orders</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="summary--widget">
                            <div class="summary--item">
                                <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>
                                <p class="summary--title">This Month</p>
                                <p class="summary--stats text-green">2,371,527</p>
                            </div>
                            <div class="summary--item">
                                <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>
                                <p class="summary--title">Last Month</p>
                                <p class="summary--stats text-orange">2,527,371</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content">
            <div class="panel">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class=" col col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center">
                            Order Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h1>Customer Info</h1>
                            <hr/>
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <td>{{ $customer->name}}</td>
                                </tr>
                                <tr>
                                    <th>Customer Email</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>User Type</th>
                                    <td>{{ $customer->role }}</td>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <h1>Shipping Info</h1>
                            <hr/>
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Shipping Name</th>
                                    <td>{{ $ShippingDetails->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td>{{ $ShippingDetails->address1 }}</td>
                                </tr>
                                <tr>
                                    <th>Address 2</th>
                                    <td>{{ $ShippingDetails->address2 }}</td>
                                </tr>
                                <tr>
                                    <th>phone</th>
                                    <td>{{ $ShippingDetails->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Post Code</th>
                                    <td>{{ $ShippingDetails->postCode }}</td>
                                </tr>
                                <tr>
                                    <th>Town</th>
                                    <td>{{ $ShippingDetails->town }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $ShippingDetails->state }}</td>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <h1>Product Info</h1>
                            <hr/>
                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Product Net Price</th>
                                    <th>Product Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                @php($i=1)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $product->product_id }}</td>
                                        <td>{{ $product->productName }}</td>
                                        <td>TK. {{ $product->productPrice }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>TK. {{ $product->total_amount }}</td>

                                    </tr>
                                @endforeach
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </section>
        <footer class="main--footer main--footer-light">
            <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
        </footer>
    </main>
@endsection