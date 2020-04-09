@extends('backend.master')

@section('title')
    Beauty Shop | Brands
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

            <div class="panel">
                <div class="records--list" data-title="Product Listing">
                    <table id="recordsListView">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer ID</th>
                            <th>shipping id</th>
                            <th>Cost</th>
                            <th class="not-sortable">Condition</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customerOrder as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>{{$value->customer_id}}</td>
                                <td>{{$value->shipping_id}} </td>
                                <td>{{$value->total_order_cost}} </td>
                                <td>@if($value->status==1)
                                        <span class="label label-success">Delivered</span>
                                    @else
                                        <span class="label label-danger">Pending</span>@endif
                                </td>
                                <td>
                                    <div class="dropleft">
                                        <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu"> <a href="{{url('/view-order-details/'.$value->id)}}" class="dropdown-item">view</a>
                                            @if($value->status==0)
                                                <a href="{{url('/confirm-delivery/'.$value->id)}}" class="dropdown-item">Confirm</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <footer class="main--footer main--footer-light">
            <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
        </footer>
    </main>
@endsection