@extends('backend.master')

@section('title')
    Beauty Shop | Products
    @endsection

@section('content')
    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Products</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Ecommerce</a></li>
                            <li class="breadcrumb-item active"><span>Products</span></li>
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
                        <h3 class="h3">Ecommerce Products <a href="#" class="btn btn-sm btn-outline-info">Manage Products</a></h3>
                        <p>Found Total {{$productsCount}} Products</p>
                    </div>
                    <div class="actions">
                        <div class="panel-content py-5"> <a href="#formInModal" class="btn btn-rounded btn-block btn-success" data-toggle="modal">Add Product</a> </div>
                        <h3 style="text-align: center" class="text-success" >{{ Session::get('message') }}</h3>
                    </div>
                    <div class="col-md-12">
                        <div id="formInModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="text-align: center">Add Product Form</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{url('/new-product')}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    <div class="modal-body pt-12" style="max-width: 100%">
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Brand<span style="color: red">*</span></span>
                                            <div class="col-md-8">
                                                <select name="brandId" class="form-control" style="border-bottom: 3px solid ; border-radius: 10px;">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                        @endforeach
                                                </select>
                                                <span style="color: red;">{{ $errors->has('brandId') ? $errors->first('brandId') : ' ' }}</span>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Category<span style="color: red">*</span></span>
                                            <div class="col-md-8">
                                                <select name="catId" id="category" class="form-control" style="border-bottom: 3px solid ; border-radius: 10px;">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span style="color: red;">{{ $errors->has('catId') ? $errors->first('catId') : ' ' }}</span>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Sub Category<span style="color: red">*</span></span>
                                            <div class="col-md-8">
                                                <select name="subCatId" id="subcategory" class="form-control" style="border-bottom: 3px solid ; border-radius: 10px;">
                                                    <option> Sub Category</option>
                                                </select>
                                                <span style="color: red;">{{ $errors->has('subCatId') ? $errors->first('subCatId') : ' ' }}</span>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Name<span style="color: red">*</span></span>
                                            <div class="col-md-8"> <input type="text" value="{{old('productName')}}" name="productName" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Enter Product name.." class="form-control">
                                            <span style="color: red;">{{ $errors->has('productName') ? $errors->first('productName') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Price<span style="color: red">*</span></span>
                                            <div class="col-md-8"> <input type="number" value="{{old('productPrice')}}" name="productPrice" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Enter Product Price.." class="form-control">
                                            <span style="color: red;">{{ $errors->has('productPrice') ? $errors->first('productPrice') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Serial<span style="color: red">*</span></span>
                                            <div class="col-md-8"> <input name="productSerial" type="text" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Enter Product Serial.." class="form-control">
                                            <span style="color: red;">{{ $errors->has('productSerial') ? $errors->first('productSerial') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Quantity<span style="color: red">*</span></span>
                                            <div class="col-md-8"> <input type="number" name="quantity" value="{{old('quantity')}}" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Enter Product quantity.." class="form-control">
                                            <span style="color: red;">{{ $errors->has('quantity') ? $errors->first('quantity') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Discount</span>
                                            <div class="col-md-8"> <input type="number" name="discount" value="0" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Ex:10/20(In percentange)" class="form-control">
                                            <span style="color: red;">{{ $errors->has('discount') ? $errors->first('discount') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Product Description<span style="color: red">*</span></span>
                                            <div class="col-md-8"> <textarea name="productDetails" style="border-bottom: 3px solid ; border-radius: 5px;"  class="form-control" placeholder="Enter Product Description...">{{old('productDetails')}}</textarea>
                                            <span style="color: red;">{{ $errors->has('productDetails') ? $errors->first('productDetails') : ' ' }}</span>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="">Feature Picture<span style="color: red">*</span></span>
                                            <div class="col-md-8"><input type="file" accept="image/*" name="productImage" style="height: 80%" class="custom-file-input"><span class="custom-file-label">Choose Image</span>
                                            <span style="color: red;">{{ $errors->has('productImage') ? $errors->first('productImage') : ' ' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="label-text col-md-4 col-form-label text-md-right" style="">Additional Image</span>
                                            <div class="col-md-8"><input type="file" accept="image/*" name="additionalImage[]" style="height: 80%" class="custom-file-input" multiple><span class="custom-file-label">Choose Muliple Image</span>
                                            </div>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success"> <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel">
                <div class="records--list" data-title="Product Listing">
                    <table id="recordsListView">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="not-sortable">Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Created Date</th>
                            <th>Product Details</th>
                            <th>Status</th>
                            <th class="not-sortable">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td> <a href="#" class="btn-link">#{{$product->id}}</a> </td>
                            <td> <a href="#" class="btn-link"> <img src="{{asset($product->productImage)}}" alt=""> </a> </td>
                            <td> <a href="#" class="btn-link">{{$product->productName}}</a> </td>
                            <td> <a href="#" class="btn-link">{{$product->category_name}}</a> </td>
                            <td>{{$product->brand_name}}</td>
                            <td>{{$product->productPrice}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->discount}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->productDetails}}</td>
                            <td> @if($product->status==1)
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Unpublished</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropleft">
                                    <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu"> <a href="{{url('/edit-product/'.$product->slug)}}" class="dropdown-item">Edit</a>
                                        @if($product->status==0)
                                            <a href="{{url('/publish-product/'.$product->slug)}}" class="dropdown-item">Publish</a>
                                        @else
                                            <a href="{{url('/unPublish-product/'.$product->slug)}}" class="dropdown-item">UnPublish</a>
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
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#category").on("change", function(){
            var id = this.value;
            getSubCategory(id);
        });

        function getSubCategory(id){


            $.ajax({
                type: 'POST',
                url: '{{url('/subcategorybyid')}}',
                data: {id:id,"_token":"{{csrf_token()}}"},


            }).done(function(data) {
                $('#subcategory').empty();
                $.each(JSON.parse(data), function (index, subcatObj) {
                    $('#subcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.title+'</option>');
                })

            });
        }

    </script>

    @endsection


