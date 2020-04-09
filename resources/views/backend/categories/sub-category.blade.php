@extends('backend.master')

@section('title')
    Beauty Shop | Categories
@endsection

@section('content')
    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Categories</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Ecommerce</a></li>
                            <li class="breadcrumb-item active"><span>Sub categories</span></li>
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
                    <div class="alert alert-success" style="text-align: center">
                        {{ Session::get('message') }}
                    </div>
                @endif
                    @if(Session::has('msg'))
                        <div class="alert alert-danger" style="text-align: center">
                            {{ Session::get('msg') }}
                        </div>
                    @endif
                <div class="records--header">
                    <div class="title fa-shopping-bag">
                        <h3 class="h3">Ecommerce Sub Categories <a href="#" class="btn btn-sm btn-outline-info">Manage Sub Category</a></h3>
                    </div>
                    <div class="actions">
                        <div class="panel-content py-5"> <a href="#formInModal" class="btn btn-rounded btn-block btn-success" data-toggle="modal">Add Sub-Category</a> </div>

                    </div>
                    <div class="col-md-12">
                        <div id="formInModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="text-align: center">Add Sub Category Form</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ url('/new-sub-category') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-body pt-12" style="max-width: 100%">
                                            <div class="form-group row">
                                                <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Category</span>
                                                <div class="col-md-8">
                                                    <select name="category_id" class="form-control" style="border-bottom: 3px solid ; border-radius: 10px;">
                                                        <option value="">Select Category</option>
                                                        @foreach($allCategories as $allCategory)
                                                        <option value="{{$allCategory->id}}">{{$allCategory->category_name}}</option>
                                                            @endforeach
                                                    </select>
                                                    <span style="color: red;">{{ $errors->has('category_id') ? $errors->first('category_id') : ' ' }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Sub-Category Name</span>
                                                <div class="col-md-8"> <input type="text" name="title" style="border-bottom: 3px solid ; border-radius: 5px;" placeholder="Enter Product name.." class="form-control"><span style="color: red;">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span> </div>
                                            </div>
                                            <div class="form-group row">
                                                <span class="label-text col-md-4 col-form-label text-md-right" style="padding-top: 22px;">Sub-Category Description</span>
                                                <div class="col-md-8"> <textarea name="description" style="border-bottom: 3px solid ; border-radius: 5px;"  class="form-control" placeholder="Enter Product Description..."></textarea><span style="color: red;">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span></div>
                                            </div>
                                            <div class="form-group row">
                                                <span class="label-text col-md-4 col-form-label text-md-right" style="">Category Image</span>
                                                <div class="col-md-8"><input type="file" name="category_image" style="height: 80%" class="custom-file-input"><span class="custom-file-label">Choose File</span></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8 "> <input type="submit" value="Submit" class="btn btn-xs btn-rounded btn-success"> <button type="button" class="btn btn-xs btn-rounded btn-outline-danger" data-dismiss="modal">Cancel</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel">
                <div class="records--list" data-title="Sub-Category Listing">
                    <table id="recordsListView">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="not-sortable">Category Name</th>
                            <th>Sub-Category Name</th>
                            <th>Sub-Category Description</th>
                            <th>Status</th>
                            <th class="not-sortable">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allSubCategories as $allSubCategory)
                            <tr>
                                <td>{{$allSubCategory->id}}</td>
                                <td>{{$allSubCategory->category_name}}</td>
                                <td>{{$allSubCategory->title}}</td>
                                <td>{{$allSubCategory->description}} </td>
                                <td>
                                    @if($allSubCategory->status==1)
                                        <span class="label label-success">Published</span>
                                    @else
                                        <span class="label label-danger">Unpublished</span>@endif
                                </td>
                                <td>
                                    <div class="dropleft">
                                        <a href="#" class="btn-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu"> <a href="{{url('/edit-sub-category/'.$allSubCategory->slug)}}" class="dropdown-item">Edit</a>
                                            @if($allSubCategory->status==0)
                                                <a href="{{url('/publish-sub-category/'.$allSubCategory->slug)}}" class="dropdown-item">Publish</a>
                                            @else
                                                <a href="{{url('/unPublish-sub-category/'.$allSubCategory->slug)}}" class="dropdown-item">UnPublish</a>
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