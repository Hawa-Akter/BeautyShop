@extends('backend.master')

@section('title')
    Admin | Add Beautician
@endsection


@section('content')
    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Add Beautician</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Ecommerce</a></li>
                            <li class="breadcrumb-item active"><span>Add Beautician</span></li>
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
                <div class="records--header">
                    <div class="title fa-shopping-bag">
                        <h3 class="h3">Ecommerce Beautician <a href="#" class="btn btn-sm btn-outline-info">Add Beautician</a></h3>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="records--body">
                    <div class="title">
                        <h6 class="h6">Add Beautician</h6>
                          </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"> <a href="#tab01" data-toggle="tab" class="nav-link active">Basic</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab01">
                            <form action="{{ url('/save-beautitian') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3">Make Beautician</label>
                                    <div class="col-sm-9">
                                        <select name="user_id" required class="form-control">
                                            <option value="">---Select User---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} ({{$user->email}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <input type="submit" name="btn" class="btn btn-success btn-block" value="Make Beautician"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="records--list" data-title="User Listing">
                    <table id="recordsListView">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Role</th>
                            <th>Joining Date</th>
                            <th class="not-sortable">Condition</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($beautitians as $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->role}}</td>
                                <td>{{$value->created_at}} </td>
                                <td>
                                    <div class="dropleft">
                                        <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu"> <a href="{{url('/view-order-details/'.$value->id)}}" class="dropdown-item">view</a>
                                            @if($value->status==0)
                                                <a href="{{url('/confirm-delivery/'.$value->id)}}" class="dropdown-item">Confirm</a>
                                            @else
                                                <a href="{{url('/admin/unPublish-brand/'.$value->id)}}" class="dropdown-item">UnPublish</a>
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