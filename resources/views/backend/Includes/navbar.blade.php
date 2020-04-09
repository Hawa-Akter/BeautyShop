<header class="navbar navbar-fixed">
    <div class="navbar--header"> <a href="{{url('/admin')}}" class="logo"> <img src="{{asset('AdminAssets/')}}//img/logo.png" alt=""> </a> <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar"> <i class="fa fa-bars"></i> </a> </div>
    <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar"> <i class="fa fa-bars"></i> </a>
    <div class="navbar--search">
        <form action="http://themelooks.net/demo/dadmin/html/search-results.html"> <input type="search" name="search" class="form-control" placeholder="Search Something..." required> <button class="btn-link"><i class="fa fa-search"></i></button> </form>
    </div>
    <div class="navbar--nav ml-auto">
        <ul class="nav">
            <li class="nav-item"> <a href="#" class="nav-link"> <i class="fa fa-bell"></i> <span class="badge text-white bg-blue">7</span> </a> </li>
            <li class="nav-item"> <a href="mailbox_inbox.html" class="nav-link"> <i class="fa fa-envelope"></i> <span class="badge text-white bg-blue">4</span> </a> </li>
            <li class="nav-item dropdown nav-language">
                <a href="#" class="nav-link" data-toggle="dropdown"> <img src="{{asset('AdminAssets/')}}//img/flags/us.png" alt=""> <span>English</span> <i class="fa fa-angle-down"></i> </a>
                <ul class="dropdown-menu">
                    <li> <a href="#"> <img src="{{asset('AdminAssets/')}}//img/flags/de.png" alt=""> <span>German</span> </a> </li>
                    <li> <a href="#"> <img src="{{asset('AdminAssets/')}}//img/flags/fr.png" alt=""> <span>French</span> </a> </li>
                    <li> <a href="#"> <img src="{{asset('AdminAssets/')}}//img/flags/us.png" alt=""> <span>English</span> </a> </li>
                </ul>
            </li>
            <li class="nav-item dropdown nav--user online">
                <a href="#" class="nav-link" data-toggle="dropdown"> <img src="{{asset('AdminAssets/')}}//img/avatars/df.png" alt="" class="rounded-circle"> <span>{{Auth::user()->name}}</span> <i class="fa fa-angle-down"></i> </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-power-off"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<aside class="sidebar" data-trigger="scrollbar">
    <div class="sidebar--profile">
        <div class="profile--img"> <a href="profile.html"> <img src="{{asset('AdminAssets/')}}//img/avatars/df.png" height="80px" width="80px" alt="" class="rounded-circle"> </a> </div>
        <div class="profile--name"> <a href="profile.html" class="btn-link">{{Auth::user()->name}}</a> </div>
        <div class="profile--nav">
            <ul class="nav">
                <li class="nav-item"> <a href="profile.html" class="nav-link" title="User Profile"> <i class="fa fa-user"></i> </a> </li>
                <li class="nav-item"> <a href="lock-screen.html" class="nav-link" title="Lock Screen"> <i class="fa fa-lock"></i> </a> </li>
                <li class="nav-item"> <a href="mailbox_inbox.html" class="nav-link" title="Messages"> <i class="fa fa-envelope"></i> </a> </li>
                <li class="nav-item"> <a class="nav-link dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>
    </div>
    <div class="sidebar--nav">
        <ul>
            <li>
                <ul>
                    <li class="active"> <a href="{{url('/admin')}}"> <i class="fa fa-home"></i> <span>Dashboard</span> </a> </li>
                    <li>
                        <a href="#"> <i class="fa fa-shopping-cart"></i> <span>Ecommerce</span> </a>
                        <ul>
                            <li><a href="{{url('/home')}}">Ecommerce view</a></li>
                            <li><a href="{{url('/admin')}}">Dashboard</a></li>
                            <li><a href="{{url('/beautyProduct')}}">Products</a></li>

                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Brand&Categories</a>
                <ul>
                    <li>
                        <a href="#"> <i class="fa fa-th"></i> <span>Category</span> </a>
                        <ul>
                            <li><a href="blank.html"></a></li>
                            <li><a href="{{url('/productCategories')}}">Manage Categories</a></li>
                            <li><a href="{{url('/productSubCategories')}}">Manage Sub-Categories</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"> <i class="fa fa-th-list"></i> <span>Brand</span> </a>
                        <ul>
                            <li><a href="{{url('/manage-brand')}}">Manage brand</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Order&View</a>
                <ul>
                    <li><a href="{{url('/all-order')}}">Orders</a></li>
                    <li><a href="{{url('/market-order')}}">Market Orders</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Users</a>
                <ul>
                    <li><a href="{{url('/all-users')}}">All Users</a></li>
                    <li><a href="{{url('/add-new-beautitian')}}">ADD Beautician</a></li>
                </ul>
            </li>

        </ul>
    </div>
   </aside>
  