@extends('frontEnd.master')

@section('title')
    BeautyShop | Blog Details

    @endsection

@section('content')

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="#"><i class="icon-home"></i> Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Single</span>
                        <h2 class="entry-title">Blog Categories</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="blog-post">

                        <div class="post-thumb">
                            <a href="#"><img src="{{$BlogById2->blog_image!=null? asset($BlogById2->blog_image):'assets/img/blog/img-1.jpg'}}" alt=""></a>
                            <div class="hover-wrap">
                            </div>
                        </div>


                        <div class="post-content">
                            <h4 class="post-title"><a href="#">{{$BlogById2->title}}</a></h4>
                            <div class="meta">
                                <span class="meta-part"><a href="#"><i class="icon-user"></i> {{$BlogById2->name}}</a></span>
                                <span class="meta-part"><a href="#"><i class="icon-speech"></i> {{$BlogById2->view}} Views</a></span>
                                <span class="meta-part"><a href="#"><i class="icon-calendar"></i> {{$BlogById2->created_at}}</a></span>
                                @if($BlogById2->user_id==Auth::user()->id)
                                <span class="meta-part"><a class="btn-quickview md-trigger" data-modal="modal-22"><i class="icon-pencil"></i><button> Edit-Blog</button></a></span>
                                    <span class="meta-part"><a href="{{url('/delete-blog/'.$BlogById2->slug)}}"><i class="icon-trash"></i> Delete Blog</a></span>
                                    @endif
                            </div>
                               <p>{{$BlogById2->details_blog}}</p>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if($BlogById2->video_link!=null)
                                    <iframe width="100%" height="315"
                                            src="https://www.youtube.com/embed/{{$BlogById2->video_link}}">
                                    </iframe>
                                        @endif
                                </div>
                            </div>
                        </div>


                        <div class="share">
                            <div class="pull-left">
                                <div class="post-tags-list">
                                    <span><i class="icon-tag"></i></span>
                                    <a href="#">{{$BlogById2->category}}</a>
                                </div>
                            </div>
                            <div class="social-link pull-right">
                                <a href="#"><i class="icon-social-twitter"></i></a>
                                <a href="#"><i class="icon-social-facebook"></i></a>
                                <a href="#"><i class="icon-social-google"></i></a>
                                <a href="#"><i class="icon-social-linkedin"></i></a>
                            </div>
                        </div>

                    </div>


                    <div id="comments">
                        <h2 class="comments-title">{{$allComments->count($BlogById2->id)}} Comments:</h2>
                        <ol class="comments-list">
                            @foreach($allComments->CommnetByID($BlogById2->id) as $comment)
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img alt="sdaf" src="{{isset($allComments->profilePicture($comment->user_id)->photo) && $allComments->profilePicture($comment->user_id)->photo!=null? asset($allComments->profilePicture($comment->user_id)->photo) :asset('assets/img/blog/user1.png')}}" width="80px" height="80px">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$comment->subject}}</h4>
                                        <div class="meta">
                                            <span class="meta-part"><a href="#"><i class="icon-user"></i>{{$comment->name}}</a></span>
                                            <span class="meta-part"><a href="#"><i class="icon-calendar"></i> {{$comment->created_at}}</a></span>
                                            <a href="#reply" class="reply-link"> <i class="fa fa-reply-all"></i> Reply</a>
                                        </div>
                                        <p>{{$comment->comment_description}}</p>
                                    </div>
                                </div>
                            </li>
                                @endforeach
                        </ol>

                        <div id="respond">
                            <h2 id="reply" class="respond-title">Leave A reply:</h2>
                            <form action="{{url('/new-comment')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input  class="form-control" name="subject" required type="text" value="" size="30" placeholder="Subject">
                                            <input class="form-control" name="blog_id" type="hidden" value="{{$BlogById2->id}}" size="30">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="comment" required class="form-control" name="comment" cols="45" rows="8" placeholder="Write your comments.."></textarea>
                                        </div>
                                        <input type="submit" id="submit" class="btn btn-common" value="Post Comment"/>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

                <aside id="sidebar" class="col-md-4 right-sidebar">
                    <div class="widget widget-categories">
                        <h4 class="w-title" style="text-align: center   ">{{$BlogById2->name}}</h4>
                        <img src="{{asset($BlogById2->photo)}}" height="300px" width="300px" alt="">
                        <div class="about-widget-content">
                            @if($checkRate>0)
                            <h5>You already Rated</h5>
                                @else
                                <h5>Your Rating</h5>
                                <div id="rater-step1"></div>
                                @endif
                        </div>
                    </div>
                    <div class="widget widget-popular-posts">
                        <h4 class="w-title">Recent Posts</h4>
                        <ul class="posts-list">
                            @foreach($recentPosts as $recentPost)
                            <li>
                                <div class="widget-thumb">
                                    <a href="#"><img src="{{asset($recentPost->blog_image)}}" alt="" /></a>
                                </div>
                                <div class="widget-content">
                                    <a href="{{url('/details-blog/'.$recentPost->slug)}}">{{$recentPost->title}}</a>
                                    <span><i class="icon-calendar"></i>{{$recentPost->created_at}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                                @endforeach
                        </ul>
                    </div>




                    <div class="widget widget-categories">
                        <h4 class="w-title">Categories</h4>
                        <ul class="cat-list">
                            <li>
                                <a href="#"><i class="icon-folder-alt"></i> All about clothing <span class="num-posts">(50)</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-folder-alt"></i> Make-up & beauty <span class="num-posts">(18)</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-folder-alt"></i> Accessories <span class="num-posts">(0)</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-folder-alt"></i> Fashion trends <span class="num-posts">(11)</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-folder-alt"></i> Haircuts & hairstyles <span class="num-posts">(15)</span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="add">
                        <img src="{{asset('/')}}assets/img/blog/add-blog.jpg" alt="">
                    </div>

                    <div class="widget tag">
                        <h4 class="w-title">Popular Tags</h4>
                       @foreach($taggs as $tagg)
                        <a href="#"> {{$tagg->category}}</a>
                           @endforeach

                    </div>
                </aside>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="md-modal md-effect-3" id="modal-22">
            <h3 style="text-align: center; background-color: white;">EDIT BLOG</h3>
            <div class="md-content">

                <div class="product-info row">
                    <form action="{{url('/update-blog')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 ">
                                <input id="author" class="form-control" name="title" type="text" value="{{$BlogById2->title}}" size="30" placeholder="Title">
                                <span style="color: red;">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="author" class="form-control" name="topic" type="text" value="{{$BlogById2->category}}" size="30" placeholder="Topic">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="file" class="form-control" name="photo" type="file" placeholder="photo"/>
                                    <input  class="form-control" name="id" value="{{$BlogById2->id}}" type="hidden" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="comment" class="form-control" name="details_blog" cols="45" rows="8" placeholder="Details of topic">{{$BlogById2->details_blog}}</textarea>
                                    <span style="color: red;">{{ $errors->has('details_blog') ? $errors->first('details_blog') : ' ' }}</span>

                                </div>
                                <input type="submit" id="submit" class="btn btn-common" value="Update Blog"/>
                            </div>
                        </div>
                    </form>
                </div>

                <button class="md-close"><i class="icon-close"></i></button>
            </div>
        </div>
    </div>


@endsection


@section('additionalScript')



    <script src="{{asset('rater/')}}/example/index.js?v=2"></script>
    <script src="{{asset('rater/')}}/index.js?v=2"></script>


    <script>
        function onload(event) {

            var myDataService =  {
                rate:function(rating) {
                    return {then:function (callback) {

                        setTimeout(function () {
                            callback((Math.random() * 5));
                        }, 1000);
                    }
                    }
                }
            }


            var starRatingStep = raterJs( {
                starSize:28,
                step:0.5,
                element:document.querySelector("#rater-step1"),
                rateCallback:function rateCallback(rating, done) {
                    this.setRating(rating);
//                alert(window.location.pathname);
                    var initial_url=window.location.pathname;
                    var url = initial_url .split( '/' );
                    var product_slug= url[ url.length - 1 ];

                    $.ajax({
                        type: 'POST',
                        url: '{{url('/rating-on-beautitian')}}',
                        data: {UserID:'{{Auth::user()->id}}',BId:'{{$BlogById2->user_id}}',rate:rating,"_token":"{{csrf_token()}}"},
                    }).done(function( msg ) {
                        console.log(msg)
                    });
                    $('#rater-step1').hide();
                    done();
                }
            });


        }

        window.addEventListener("load", onload, false);
    </script>


@endsection