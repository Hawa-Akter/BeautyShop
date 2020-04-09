@extends('frontEnd.master')
@section('title')
    BeautyShop | Blog
    @endsection

@section('content')


    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Blog</span>
                        <h2 class="entry-title">Blog Categories</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content">

        <div class="container">
            <h3 style="text-align: center" class="text-success" >{{ Session::get('mess') }}</h3>
            @if(Auth::user()->role=="beautitian")
            <a class="btn-quickview md-trigger" data-modal="modal-2"><button class=" btn btn-common">ADD Blog</button></a>
            @endif
            <div class="row">
                <div class="md-modal md-effect-3" id="modal-2">
                    <h3 style="text-align: center; background-color: white;">ADD BLOG</h3>
                    <div class="md-content">

                        <div class="product-info row">
                            <form action="{{url('/new-blog')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <input id="author" class="form-control" name="title" type="text" value="{{old('title')}}" size="30" placeholder="Title">
                                        <span style="color: red;">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input id="author" class="form-control" name="topic" required type="text" value="" size="30" placeholder="Topic">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input id="file" class="form-control" name="photo" type="file" placeholder="photo"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input id="author" class="form-control" name="video_link" type="text" value="{{old('video_link')}}" size="30" placeholder="Youtube Video Link">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="comment" class="form-control" name="details_blog" cols="45" rows="8" placeholder="Details of topic">{{old('details_blog')}}</textarea>
                                            <span style="color: red;">{{ $errors->has('details_blog') ? $errors->first('details_blog') : ' ' }}</span>

                                        </div>
                                        <input type="submit" id="submit" class="btn btn-common" value="Post Status"/>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <button class="md-close"><i class="icon-close"></i></button>
                    </div>
                </div>

                <aside id="sidebar" class="col-md-4 right-sidebar">

                    <div class="widget widget-popular-posts">
                        <h4 class="w-title">Recent Posts</h4>
                        <ul class="posts-list">
                            @foreach($recentPosts as $recentPost)
                            <li>
                                <div class="widget-thumb">
                                    <a href="#"><img src="{{asset($recentPost->blog_image)}}" alt="" /></a>
                                </div>
                                <div class="widget-content">
                                    <a href="#">{{$recentPost->title}}</a>
                                    <span><i class="icon-calendar"></i>{{$recentPost->created_at}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                                @endforeach
                        </ul>
                    </div>

                    <div class="widget widget-categories">
                        <h4 class="w-title">About</h4>
                        <img src="assets/img/blog/about-w.jpg" alt="">
                        <div class="about-widget-content">
                            <h5>Pellentesque malesapibus maximus.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias illum ratione,</p>
                        </div>
                    </div>

                    <div class="add">
                        <img src="assets/img/blog/add-blog.jpg" alt="">
                    </div>

                    <div class="widget tag">
                        <h4 class="w-title">Popular Tags</h4>
                        <a href="#"> Fashion</a>
                        <a href="#"> Clothing</a>
                        <a href="#"> Trends</a>
                        <a href="#"> Shoes</a>
                        <a href="#"> Tops</a>
                        <a href="#"> Sell Off</a>
                        <a href="#"> Women Fashion</a>
                    </div>
                </aside>

                <div class="col-md-8">
                @foreach($allBlogs as $allBlog)
                    <div class="blog-post">

                        <div class="post-thumb">
                            <a href="#"><img src="{{$allBlog->blog_image!=null? asset($allBlog->blog_image):'assets/img/blog/img-1.jpg'}}" width="750px" height="230px" alt=""></a>
                            <div class="hover-wrap">
                            </div>
                        </div>


                        <div class="post-content">
                            <h4 class="post-title"><a href="#">{{$allBlog->title}}</a></h4>
                            <div class="meta">
                                <span class="meta-part"><a href="#"><i class="icon-user"></i> {{$allBlog->name}}</a></span>
                                <span class="meta-part"><a href="#"><i class="icon-speech"></i> {{$allBlog->view}} Views</a></span>
                                <span class="meta-part"><a href="#"><i class="icon-calendar"></i> {{$allBlog->created_at}}</a></span>
                            </div>

                            <a href="{{url('/details-blog/'.$allBlog->slug)}}" class="readmore">Read More</a>
                        </div>

                    </div>
                @endforeach
                   <div class="pagination">
                        <div class="results-navigation pull-left">
                            Showing: 1 - 6 Of 17
                        </div>
                        <nav class="navigation pull-right">
                            <span class="current page-num">1</span>
                            <a class="page-num" href="#">2</a>
                            <a class="page-num" href="#">3</a>
                            <div class="divider">...</div>
                            <a class="next-page" href="#"><i class="fa fa-angle-right"></i></a>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection