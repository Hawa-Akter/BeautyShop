@extends('frontEnd.master')
@section('title')
    Ecommerce|Profile
    @endsection


@section('content')


    <div class="container bootstrap snippet">
        <div class="row" style="padding-bottom: 20px; padding-top:40px;">
            <div class="col-sm-12"><h1 style="text-align: center; text-transform: uppercase;">{{Auth::user()->name}} Account</h1>  </div>
        </div>
        <div class="row" >

                    </hr><br>

                </div><!--/col-3-->
                <div class="col-sm-12" >
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#stock">Current Stock</a></li>
                        <li><a data-toggle="tab" href="#history">Sell-History</a></li>
                        <li><a data-toggle="tab" href="#orders">Orders</a></li>
                        <li><a data-toggle="tab" href="#Account">Account</a></li>
                    </ul>
                    @if(Session::get('successMessage')==!null)
                        <div class="alert alert-success" style="text-align: center">
                            <strong >{{Session::get('successMessage')}}</strong>
                        </div>
                    @endif

                    <div class="tab-content" >
                       <div class="tab-pane active" id="stock">
                            <br>
                            <h2 style="text-align: center">Available Product on Sale</h2>

                            <hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>

                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Net price</th>
                                    <th>Available Quantity</th>
                                    <th>Order time</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($CurrentStock as $product)
                                    <tr class="odd gradeX">
                                        <td><img src="{{$product->productImage}}" height="50px" width="50px"/> </td>
                                        <td>{{$product->productName}}</td>
                                        <td>{{$product->productPrice}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->created_at}}</td>


                                    </tr>
                                @endforeach
                                <!-- Trigger the modal with a button -->

                                </tbody>
                            </table>
                        </div><!--/tab-pane-->
                        <div class="tab-pane" id="history">
                            <br>
                            <h2 style="text-align: center">My Selling History</h2>
                            <hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Order ID</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Brand Name</th>
                                    <th>Net Price</th>
                                    <th>Quantity</th>
                                    <th>Product Discount</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($sellHistory as $sellHis)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }}</td>
                                        <td>#{{$sellHis->id}}</td>
                                        <td>{{$sellHis->product_id}}</td>
                                        <td>{{$sellHis->productName}}</td>
                                        <td>{{$sellHis->name}}</td>
                                        <td>{{$sellHis->net_price}}</td>
                                        <td>{{$sellHis->quantity}}</td>
                                        <td>{{$sellHis->product_discount}}</td>
                                        <td>{{$sellHis->total_amount}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="orders">
                            <br>
                            <h2 style="text-align: center">My Orders</h2>

                            <hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Order ID</th>
                                    <th>Shipping to a Address</th>
                                    <th>Total Cost</th>
                                    <th> Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($Orders as $order)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->shipping_id==0?'No':'Yes'}}</td>
                                        <td>{{$order->total_order_cost}}</td>
                                        <td>{{$order->status}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>


                        </div>
                        <div class="tab-pane" id="Account">
                            <hr>
                            <span style="color: red;">{{ $errors->has('bank_name')|$errors->has('account_number')|$errors->has('amount_of_withdraw') ? $errors->all() : ' ' }}</span>

                            <h2 style="text-align: center; padding-bottom: 40px;">Earnings</h2>
                            <div class="row" style="background-color: #F5F5F5; border-radius:10px;  padding:30px">
                                <div class="col-sm-3" style="height: 150px;">
                                    <h6 style="text-align: center;">Net Income</h6>
                                    <h3 style="text-align: center; padding-top: 50px;">৳ {{$netIncome}}</h3>
                                </div>
                                <div class="col-sm-2" style="height:150px; border-left: 1px solid #BDBDBD; border-right: 1px solid #BDBDBD">
                                    <h6 style="text-align: center; ">Withdrawn</h6>
                                    <h3 style="text-align: center; padding-top: 50px;">৳ {{$OnlyWithdraw}}</h3>
                                </div>
                                <div class="col-sm-2" style="height:150px; border-right: 1px solid #BDBDBD;">
                                    <h6 style="text-align: center;">Ecommerce Charge</h6>
                                    <h3 style="text-align: center; padding-top: 50px;">৳ {{$netIncome*10/100}}</h3>
                                </div>
                                <div class="col-sm-2" style="height:150px; border-right: 1px solid #BDBDBD;">
                                    <h6 style="text-align: center;">Pending Amount</h6>
                                    <h3 style="text-align: center; padding-top: 50px;">৳ {{$PendingForApproval}}</h3>
                                </div>
                                <div class="col-sm-3" style="height:150px;">
                                    <h6 style="text-align: center">Available Balance</h6>
                                        <h3 style="text-align: center; padding-top: 50px;">৳ {{round($netIncome-$WithdrawMoney-($netIncome)*10/100,2)}}</h3>
                                </div>

                            </div>
                            <br>
                            <a href="" class="btn btn-success" style="border-radius: 5px;" data-toggle="modal" data-target="#myModalWithdraw">WITHDRAW</a>
                        </div>
                        <div class="modal fade" id="myModalWithdraw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel" style="text-align: center">WithDraw Money</h4>
                                    </div>
                                    <form class="form-horizontal" method="post" action="{{url('/save-withdraw')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h2 class="panel-title">User ID:<span style="color: blue"> {{Auth::user()->id}}</span></h2>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Bank Name</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="bank_name" required>
                                                            <option value="">Select Bank</option>
                                                            <option value="Standard Chaterd">Standard Chaterd</option>
                                                            <option value="City">City Bank</option>
                                                            <option value="HSBC">HSBC Bank</option>
                                                            <option value="UCB">UCB Bank</option>
                                                            <option value="DBBL">DBBL Bank</option>
                                                        </select>
                                                        <span style="color: red;">{{ $errors->has('bank_name') ? $errors->first('bank_name') : ' ' }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Account name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" name="account_name">
                                                        <span style="color: red;">{{ $errors->has('account_name') ? $errors->first('account_name') : ' ' }}</span>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Account Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" required class="form-control" placeholder="--- --- ---- ------" name="account_number" maxlength=16 >
                                                        <span style="color: red;">{{ $errors->has('account_number') ? $errors->first('account_number') : ' ' }}</span>

                                                        <input type="hidden" class="form-control" name="customer_id" value="{{Auth::user()->id}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Amount Of WithDraw</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" required id="withdraw" onblur="GetCommision();" class="form-control" max="{{$netIncome-$WithdrawMoney-($netIncome)*10/100}}" step=any name="amount_of_withdraw" placeholder="{{$netIncome-$WithdrawMoney-($netIncome)*10/100}}">
                                                        <span style="color: red;">{{ $errors->has('amount_of_withdraw') ? $errors->first('amount_of_withdraw') : ' ' }}</span>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Ecommerce charge</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" readonly required id="commission" class="form-control" name="commission">
                                                    </div>
                                                </div>
                                                <div class="form-group" >

                                                    <div class="col-sm-offset-3 col-sm-8">
                                                        <input class="btn btn-lg btn-success" type="submit" value="WITHDRAW"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div><!--/tab-pane-->
                </div><!--/tab-content-->
        </div><!--/col-9-->
       <!-- Modal -->
        <!-- /.modal -->

    </div><!--/row-->

    <script>
        function GetCommision() {

            var x = document.getElementById("withdraw");
            var y=(x.value*100/90-x.value);
            document.getElementById("commission").value = y;
        }

       </script>

@endsection