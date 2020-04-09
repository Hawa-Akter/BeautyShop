@extends('backend.master')

@section('title')
    Admin | Edit Category
    @endsection


@section('content')
    <main class="main--container">
        <section class="page--header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="page--title h5">Edit Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}">Ecommerce</a></li>
                            <li class="breadcrumb-item active"><span>Edit Category</span></li>
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
                        <h3 class="h3">Ecommerce Products <a href="#" class="btn btn-sm btn-outline-info">Edit Categories</a></h3>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="records--body">
                    <div class="title">
                        <h6 class="h6">Category Details</h6>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"> <a href="#tab01" data-toggle="tab" class="nav-link active">Basic</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab01">
                            <form action="{{url('/update-category')}}" method="post" enctype="multipart/form-data" name="editCategoryForm">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Category Name: *</span>
                                    <div class="col-md-9">
                                        <input type="text" name="category_name" class="form-control" value="{{$categoryById->category_name}}" required>
                                        <input type="hidden" name="id" class="form-control" value="{{$categoryById->id}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Category Description:</span>
                                    <div class="col-md-9"> <textarea name="category_description" required class="form-control">{{$categoryById->category_description}}</textarea> </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Category Image:</span>
                                    <div class="col-md-9">
                                        <input type="file" name="category_image" style="height: 100%" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label"></span>
                                    <div class="col-md-9">
                                        <img src="{{ asset($categoryById->category_image)}}" alt="" height="80" width="80"/>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label text-md-right">Select Status</span>
                                    <div class="col-md-9">
                                        <select name="status" class="form-control">
                                            <option value="1">Published</option>
                                            <option value="0">UnPublished</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-9 offset-md-3"> <input type="submit" value="Update Category" class="btn btn-rounded btn-success"> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="main--footer main--footer-light">
            <p>Copyright &copy; <a href="#">DAdmin</a>. All Rights Reserved.</p>
        </footer>
    </main>

    <script>
        document.forms['editCategoryForm'].elements['status'].value = '{{ $categoryById->status }}';
    </script>
@endsection