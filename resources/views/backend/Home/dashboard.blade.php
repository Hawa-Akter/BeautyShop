@extends('backend.master')

@section('title')
    Dashboard
    @endsection

@section('content')


    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active"><span>Dashboard</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="main--content">
            <div class="row gutter-20">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="miniStats--panel">
                            <div class="miniStats--header bg-darker">
                                <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#2bb3c0">5,6,9,4,9,5,3,5,9,15,3,2,2,3,9,11,9,7,20,9,7,6</p>
                                <p class="miniStats--label text-white bg-blue"> <i class="fa fa-level-up-alt"></i> <span>10%</span> </p>
                            </div>
                            <div class="miniStats--body">
                                <i class="miniStats--icon fa fa-user text-blue"></i>
                                <p class="miniStats--caption text-blue">TOTAL</p>
                                <h3 class="miniStats--title h4">New Users</h3>
                                <p class="miniStats--num text-blue">{{$usersCount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="miniStats--panel">
                            <div class="miniStats--header bg-darker">
                                <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#e16123">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>
                                <p class="miniStats--label text-white bg-orange"> <i class="fa fa-level-down-alt"></i> <span>10%</span> </p>
                            </div>
                            <div class="miniStats--body">
                                <i class="miniStats--icon fa fa-ticket-alt text-orange"></i>
                                <p class="miniStats--caption text-orange">TOTAL</p>
                                <h3 class="miniStats--title h4">Beautitian</h3>
                                <p class="miniStats--num text-orange">{{$beautitianCount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="miniStats--panel">
                            <div class="miniStats--header bg-darker">
                                <p class="miniStats--chart" data-trigger="sparkline" data-type="bar" data-width="4" data-height="30" data-color="#009378">2,2,3,9,11,9,7,20,9,7,6,5,6,9,4,9,5,3,5,9,15,3</p>
                                <p class="miniStats--label text-white bg-green"> <i class="fa fa-level-up-alt"></i> <span>10%</span> </p>
                            </div>
                            <div class="miniStats--body">
                                <i class="miniStats--icon fa fa-rocket text-green"></i>
                                <p class="miniStats--caption text-green">TOTAL</p>
                                <h3 class="miniStats--title h4">Blogs</h3>
                                <p class="miniStats--num text-green">{{$blogsCount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Yearly Earning Graph Overview</h3>
                        </div>
                        <script>
                            var janOrder='{{$janOrder}}';
                            var febOrder='{{$febOrder}}';
                            var marOrder='{{$marOrder}}';
                            var aprOrder='{{$aprOrder}}';
                            var mayOrder='{{$mayOrder}}';
                            var janMarketOrder='{{$janMarketOrder}}';
                            var febMarketOrder='{{$febMarketOrder}}';
                            var marMarketOrder='{{$marMarketOrder}}';
                            var aprMarketOrder='{{$aprMarketOrder}}';
                            var mayMarketOrder='{{$mayMarketOrder}}';
                            var janTax='{{$JanTax}}';
                            var febTax='{{$febTax}}';
                            var marchTax='{{$marchTax}}';
                            var aprilTax='{{$aprilTax}}';
                            var mayTax='{{$mayTax}}';
                            var janRevenue='{{$janRevenue}}';
                            var febRevenue='{{$febRevenue}}';
                            var marchRevenue='{{$marchRevenue}}';
                            var aprilRevenue='{{$aprilRevenue}}';
                            var mayRevenue='{{$mayRevenue}}';
                            var JanBlog='{{$JanBlog}}';
                            var FebBlog='{{$FebBlog}}';
                            var marBlog='{{$marBlog}}';
                            var aprBlog='{{$aprBlog}}';
                            var mayBlog='{{$mayBlog}}';
                            var janComment='{{$janComment}}';
                            var febComment='{{$febComment}}';
                            var marchComment='{{$marchComment}}';
                            var aprilComment='{{$aprilComment}}';
                            var mayComment='{{$mayComment}}';




                        </script>
                        <div class="panel-chart">
                            <div id="morrisAreaChart01" class="chart--body area--chart style--1"></div>
                            <div class="chart--stats style--1">
                                <ul class="nav">
                                    <li data-overlay="1 orange">
                                        <p class="amount">৳ {{$TotalOrderCost}}</p>
                                        <p> <span class="label">Order</span> <span class="text-red"></span> </p>
                                    </li>
                                    <li data-overlay="1 red">
                                        <p class="amount">৳ {{$TotalMarketCost}}</p>
                                        <p> <span class="label">Market Order</span> <span class="text-green"></span> </p>
                                    </li>
                                    <li data-overlay="1 blue">
                                        <p class="amount">৳ {{$totalTax}}</p>
                                        <p> <span class="label">Tax</span> <span class="text-red"></span> </p>
                                    </li>
                                    <li data-overlay="1 green">
                                        <p class="amount">৳ {{$totalRevenue}}</p>
                                        <p> <span class="label">Market Revenue</span> <span class="text-green"></span> </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Blog & Comments</h3>
                        </div>
                        <div class="panel-chart">
                            <div id="morrisAreaChart02" class="chart--body area--chart style--1"></div>
                            <div class="chart--stats style--2">
                                <ul class="nav">
                                    <li>
                                        <p class="amount"> {{$totalBlog}}</p>
                                        <p data-overlay="1 red"><span class="label">TOTAL BLOG</span></p>
                                    </li>
                                    <li>
                                        <p class="amount"> {{$totalComment}}</p>
                                        <p data-overlay="1 blue"><span class="label">TOTAL COMMENT</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sales Progress</h3>
                            <div class="dropdown">
                                <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i> </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">This Week</a></li>
                                    <li><a href="#">Last Week</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-chart">
                            <div id="morrisLineChart01" class="chart--body line--chart style--1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Monthly Traffic</h3>
                            <div class="dropdown">
                                <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i> </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                    <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                    <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-chart">
                            <div id="morrisLineChart02" class="chart--body line--chart style--2"></div>
                            <div class="chart--stats style--3">
                                <ul class="nav">
                                    <li>
                                        <p data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#2bb3c0">0,5,9,7,12,15,12,5</p>
                                        <p><span class="label">Total Visitors</span></p>
                                        <p class="amount">12,202</p>
                                    </li>
                                    <li>
                                        <p data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">0,15,12,5,5,9,7,12</p>
                                        <p><span class="label">Total Sales</span></p>
                                        <p class="amount">25,051</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <select name="filter" data-trigger="selectmenu" data-minimum-results-for-search="-1">
                                    <option value="top-search">Top Search</option>
                                    <option value="average-search">Average Search</option>
                                </select>
                            </h3>
                            <div class="dropdown">
                                <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i> </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-sync"></i>Update Data</a></li>
                                    <li><a href="#"><i class="fa fa-cogs"></i>Settings</a></li>
                                    <li><a href="#"><i class="fa fa-times"></i>Remove Panel</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="vector--map" data-trigger="jvectorMap" data-map-selected='["US", "CA", "MX", "GT", "HN", "BZ", "SV", "NI", "CR", "BS", "CU", "JM", "HT", "DO", "PR", "PA", "CO", "VE", "TT", "GY", "SR", "GL", "EC", "PE", "BR", "BO", "PY", "CL", "AR", "UY", "FK"]'></div>
                            <div class="map--stats">
                                <table class="table">
                                    <tr>
                                        <td>United States</td>
                                        <td>65%</td>
                                    </tr>
                                    <tr>
                                        <td>United Kingdom</td>
                                        <td>15%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> <a href="#" class="btn-link">View All</a> </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="main--footer main--footer-light">
            <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
        </footer>
    </main>

@endsection

