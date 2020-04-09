@extends('frontEnd.master')
@section('extraCss')
    <link rel="stylesheet" type="text/css" href="{{asset('accountAsset')}}/form.css">
@endsection
@section('content')


    <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="@php if (isset($profileInfo->photo)){echo asset($profileInfo->photo);}else{echo asset('/profilePictures/profile.jpg');} @endphp" height="200px" width="200px" alt=""/>
                        <div class="file btn btn-lg btn-primary">
                            @php if (isset($profileInfo->profession)){echo $profileInfo->profession;} @endphp
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('mess'))
                        <div class="alert alert-success">
                            {{ Session::get('mess') }}
                        </div>
                    @endif
                    <div class="profile-head">
                        <h4>
                            {{$userInfo->name}}
                        </h4>
                        <h6>
                            @php if (isset($profileInfo->profession)){echo $profileInfo->profession;} @endphp
                        </h6>
                        <p class="proile-rating">RANKINGS : <span>{{$star}}/5</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$userInfo->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$userInfo->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>@php if (isset($profileInfo->profession)){echo $profileInfo->profession;} @endphp</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="">Website Link</a><br/>
                        <a href="@php if (isset($profileInfo->web_link)){echo $profileInfo->web_link;} @endphp" target="_blank">@php if (isset($profileInfo->web_link)){echo $profileInfo->web_link;} @endphp</a><br/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-work">
                    <p>SKILLS</p>
                    <a href=""> @php if (isset($profileInfo->skill_one)){echo $profileInfo->skill_one;} @endphp</a><br/>
                    <a href=""> @php if (isset($profileInfo->skill_two)){echo $profileInfo->skill_two;} @endphp</a><br/>
                    <a href=""> @php if (isset($profileInfo->skill_three)){echo $profileInfo->skill_three;} @endphp</a><br/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>YOUTUBE LINK</p>
                    <a href="@php if (isset($profileInfo->youtube_link)){echo $profileInfo->youtube_link;} @endphp" target="_blank">@php if (isset($profileInfo->youtube_link)){echo $profileInfo->youtube_link;} @endphp</a><br/>
                    </div>
                </div>
            </div>


    </div>
    <div class="container" style="background-color: white">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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

@endsection