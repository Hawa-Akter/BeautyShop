@extends('frontEnd.master')
@section('extraCss')
   <link rel="stylesheet" type="text/css" href="{{asset('accountAsset')}}/form.css">
    @endsection
@section('content')


    <div class="container emp-profile">
        <form method="post">
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
                    <input type="button" class="btn-quickview md-trigger" data-modal="modal-2" value="Edit Profile"/>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>WORK LINK</p>
                        <a href="">Website Link</a><br/>
                        <a href=""> <p>@php if (isset($profileInfo->web_link)){echo $profileInfo->web_link;} @endphp</p></a><br/>
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
        </form>
    </div>

    <div class="md-modal md-effect-3" id="modal-2">
        <h3 style="text-align: center; background-color: white;">Edit Profile</h3>
        <div class="md-content">

            <div class="product-info row">
                <form action="{{url('/edit-profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Full Name</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author" class="form-control" name="name" type="text" value="{{$userInfo->name}}" size="30" placeholder="Name">
                            <input class="form-control" name="id" type="hidden" value="@php if (isset($profileInfo->id)){echo $profileInfo->id;} @endphp">
                            <span style="color: red;">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Profession</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author" class="form-control" name="profession" type="text" value="@php if (isset($profileInfo->profession)){echo $profileInfo->profession;} @endphp" size="30" placeholder="profession">
                            <span style="color: red;">{{ $errors->has('profession') ? $errors->first('profession') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Email</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author" disabled class="form-control"  value="{{$userInfo->email}}" type="text" size="30" placeholder="Email">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Profile Picture</label>

                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="photo" type="file" size="30" >
                            <span style="color: red;">{{ $errors->has('photo') ? $errors->first('photo') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Skill 1</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="skill_one" type="text" value="@php if (isset($profileInfo->skill_one)){echo $profileInfo->skill_one;} @endphp" size="30" placeholder="Enter Speciality Or skill">
                            <span style="color: red;">{{ $errors->has('skill_one') ? $errors->first('skill_one') : ' ' }}</span>

                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Skill 2</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="skill_two" type="text" size="30" value="@php if (isset($profileInfo->skill_two)){echo $profileInfo->skill_two;} @endphp" placeholder="Enter Speciality Or skill">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Skill 3</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="skill_three" type="text" size="30" value="@php if (isset($profileInfo->skill_three)){echo $profileInfo->skill_three;} @endphp" placeholder="Enter Speciality Or skill">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Website Link</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="web_link" type="text" size="30" value="@php if (isset($profileInfo->web_link)){echo $profileInfo->web_link;} @endphp" placeholder="Enter personal website link">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-md-3 col-md-offset-2">
                            <label id="author" style="text-align: center"  >Youtube Link</label>
                        </div>
                        <div class="col-md-5 ">
                            <input id="author"  class="form-control" name="youtube_link" type="text" size="30" value="@php if (isset($profileInfo->youtube_link)){echo $profileInfo->youtube_link;} @endphp" placeholder="Enter youtube link">
                        </div>
                    </div>

                    <input type="submit" id="submit" class="btn btn-common" value="Save Change"/>
                </form>
            </div>

            <button class="md-close"><i class="icon-close"></i></button>
        </div>
    </div>

@endsection