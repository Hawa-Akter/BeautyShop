<div class="header">

    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-4">
                    <div class="language-wrapper">
                        <div class="box-language">

                        </div>
                        <div class="box-currency">
                            <form method="post" id="form-currency">
                                <div class="btn-group toggle-wrap">
<span class="toggle">
$USD
</span>
                                    <ul class="toggle_cont pull-right">
                                        <li>
                                            <button class="currency-select selected" type="button" name="USD">
                                                $ USD </button>
                                        </li>
                                        <li>
                                            <button class="currency-select" type="button" name="EUR">
                                                € EUR
                                            </button>
                                        </li>
                                        <li>
                                            <button class="currency-select" type="button" name="GBP">
                                                £ GBP </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <a href="#"><i class="icon-phone"></i> Call Us: (123) 456- 789</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="col-md-6 col-sm-8">



                    <div class="shop-cart">
                        <ul>
                            <li style="padding-right:10px">
                                <a href="{{url('/cart-products')}}" class="cart-icon cart-btn"><i class="icon-basket-loaded"></i><span class="cart-label">{{Cart::instance('shopping')->count()}}</span></a>
                                <div class="cart-box">
                                    <div class="popup-container">
                                        @foreach(Cart::instance('shopping')->content() as $item)
                                            <div class="cart-entry">
                                                <a href="#" class="image">
                                                    <img src="{{asset($item->options->productImage)}}" alt="">
                                                </a>
                                                <div class="content">
                                                    <a href="#" class="title">{{$item->name}}</a>
                                                    <p class="quantity">Quantity: {{$item->qty}}</p>
                                                    <span class="price">৳ {{$item->qty*($item->price)}}</span>
                                                </div>
                                                <div class="button-x">
                                                    <a href="{{url('/remove-from-cart/'.$item->rowId)}}"><i class="icon-close"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                            <div class="summary">
                                                <div class="subtotal">Sub Total</div>
                                                <div class="price-s">৳ {{Cart::instance('shopping')->subtotal()}}</div>
                                            </div>
                                            <div class="cart-buttons">
                                                <a href="{{url('/cart-products')}}" class="btn btn-border-2">View Cart</a>
                                                <a href="{{url('show-checkout-content')}}" class="btn btn-common">Checkout</a>
                                                <div class="clear"></div>
                                            </div>
                                    </div>
                                </div>
                            </li>
                            <li style="padding-right:10px"><a class="cart-icon cart-btn" href="{{url('/wishlist')}}"><span class="icon-heart"></span></a></li>
                            <li style="padding-right:10px"><a class="cart-icon cart-btn" href="{{url('/show-compare-product')}}"><span class="icon-chart"></span></a></li>
                            <li>
                                <a href="{{url('/market-cart-products')}}" class="cart-icon cart-btn"><i class="icon-basket-loaded"></i><span class="cart-label">{{Cart::instance('market')->count()}}</span></a>
                                <div class="cart-box">
                                    <div class="popup-container">
                                        @foreach(Cart::instance('market')->content() as $item)
                                            <div class="cart-entry">
                                                <a href="#" class="image">
                                                    <img src="{{asset($item->options->productImage)}}" alt="">
                                                </a>
                                                <div class="content">
                                                    <a href="#" class="title">{{$item->name}}</a>
                                                    <p class="quantity">Quantity: {{$item->qty}}</p>
                                                    <span class="price">৳ {{$item->qty*($item->price)}}</span>
                                                </div>
                                                <div class="button-x">
                                                    <a href="{{url('/remove-from-market-cart/'.$item->rowId)}}"><i class="icon-close"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                            <div class="summary">
                                                <div class="subtotal">Sub Total</div>
                                                <div class="price-s">৳ {{Cart::instance('market')->subtotal()}}</div>
                                            </div>
                                            <div class="cart-buttons">
                                                <a href="{{url('/market-cart-products')}}" class="btn btn-border-2">View Cart</a>
                                                <a href="{{url('/market-checkout-content')}}" class="btn btn-common">Checkout</a>
                                                <div class="clear"></div>
                                            </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-default" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="row">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('assets/')}}/img/logo.png" alt="">
                    </a>
                </div>
                <div class="navbar-collapse collapse">

                    <ul class="nav navbar-nav">
                        <li>
                            <a class="{!! Request::is('/') ? 'active':'' !!}" href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a class="{!! Request::is('view-products') ? 'active':'' !!}" href="{{url('/view-products')}}">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#">Category <span class="caret"></span></a>
                            <div class="dropdown mega-menu megamenu1">
                                <div class="row">
                                    @foreach($NavCategories as $navCategory)
                                        <div class="col-sm-3 col-xs-12">
                                            <ul class="menulinks">
                                                <li class="maga-menu-title">
                                                    <a href="#">{{$navCategory->category_name}}</a>
                                                </li>
                                                @foreach($navCategory->NavigationSubCategory as $item)
                                                    <li><a href="{{url('/category/'.$navCategory->slug.'/'.$item->slug)}}">{{$item->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </li>
                        <li>
                            <a class="{!! Request::is('market-place') ? 'active':'' !!}" href="{{url('/market-place')}}">Market</a>
                        </li>
                        @if(isset(Auth::user()->role) && Auth::user()->role=="admin")
                            <li>
                                <a class="" href="{{url('/admin')}}">Admin</a>
                            </li>
                            @endif
                       <li>
                            <a class="{!! Request::is('blog') ? 'active':'' !!}" href="{{url('/blog')}}">Blog </a>
                       </li>
                        @if(isset(Auth::user()->role) && Auth::user()->role!="admin")
                        <li>
                            <a class="{!! Request::is('public-account') ? 'active':'' !!}" href="{{url('/public-account')}}">Account </a>
                       </li>

                            @endif
                        <li>
                            <a class="{!! Request::is('view-beautitians') ? 'active':'' !!}" href="{{url('/view-beautitians')}}">Beautitian </a>
                        </li>
                    </ul>

                    <div class="icon-right pull-right">
                        <div class="text-right">

                            <div class="account link-inline">
                                <div class="dropdown text-right">
                                    <a href="#" aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown">
                                        @if(isset(Auth::user()->id))
                                            <span class="icon-user"></span> {{Auth::user()->name}} <span class="icon-arrow-down"></span>
                                        @else
                                            <span class="icon-user"></span> Login <span class="icon-arrow-down"></span>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if(isset(Auth::user()->id))
                                            @if(Auth::user()->role=="beautitian")
                                        <li><a href="{{url('/my-account')}}"><span class="icon icon-user"></span>My Account</a></li>
                                            @endif
                                        <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <span class="icon icon-logout"></span>  {{ __('Logout') }}
                                            </a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                        <li><a href="{{url('/register')}}"><span class="icon icon-user-follow"></span>Register</a></li>
                                        <li><a href="{{url('/login')}}"><span class="icon icon-login"></span>Login</a></li>
                                            @endif
                                          </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <ul class="mobile-menu">
            <li>
                <a class="active" href="index.html">
                    Home
                </a>
                <ul class="dropdown">
                    <li>
                        <a class="active" href="index.html">Home V1</a>
                    </li>
                    <li>
                        <a href="index-2.html">Home V2</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="about.html">About</a>
            </li>
            <li>
                <a href="#">Catalog</a>
                <ul class="dropdown menulinks">
                    <li class="maga-menu-title">
                        <a href="#">Men</a>
                    </li>
                    <li><a href="category.html">Clothing</a></li>
                    <li><a href="category.html">Handbags</a></li>
                    <li><a href="category.html">Maternity</a></li>
                    <li><a href="category.html">Jewelry</a></li>
                    <li><a href="category.html">Scarves</a></li>
                    <li class="maga-menu-title">
                        <a href="#">Women</a>
                    </li>
                    <li><a href="category.html">Handbags</a></li>
                    <li><a href="category.html">Jewelry</a></li>
                    <li><a href="category.html">Clothing</a></li>
                    <li><a href="category.html">Watches</a></li>
                    <li><a href="category.html">Hats</a></li>
                    <li class="maga-menu-title">
                        <a href="#">Accessories</a>
                    </li>
                    <li><a href="category.html">Belts</a></li>
                    <li><a href="category.html">Scarves</a></li>
                    <li><a href="category.html">Hats</a></li>
                    <li><a href="category.html">Ties</a></li>
                    <li><a href="category.html">Handbags</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Shop</a>
                <ul class="menulinks">
                    <li class="maga-menu-title">
                        <a href="#">Shop Types</a>
                    </li>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="shop-grid.html">Shop Grid Sidebar</a></li>
                    <li><a href="shop-list.html">Shop List Sidebar</a></li>
                    <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                    <li><a href="product-details.html">Product Details</a></li>
                    <li class="maga-menu-title">
                        <a href="#">Shop Pages</a>
                    </li>
                    <li><a href="shopping-cart.html">Cart Page</a></li>
                    <li><a href="checkout.html">Checkout Page</a></li>
                    <li><a href="wishlist.html">Wishlist</a></li>
                    <li><a href="order.html">Your Order</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="login-form.html">My Account</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Pages</a>
                <ul class="dropdown">
                    <li>
                        <a href="about.html">About Us</a>
                    </li>
                    <li>
                        <a href="services.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                    <li>
                        <a href="product-details.html">Product Details</a>
                    </li>
                    <li>
                        <a href="team.html">Team Member</a>
                    </li>
                    <li>
                        <a href="checkout.html">Checkout</a>
                    </li>
                    <li>
                        <a href="shopping-cart.html">Shopping cart</a>
                    </li>
                    <li>
                        <a href="faq.html">FAQs</a>
                    </li>
                    <li>
                        <a href="wishlist.html">Wishlist</a>
                    </li>
                    <li>
                        <a href="404.html">404 Error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Blog</a>
                <ul class="dropdown">
                    <li>
                        <a href="blog.html">Blog Right Sidebar</a>
                    </li>
                    <li>
                        <a href="blog-left-sidebar.html">Blog Left Sidebar</a>
                    </li>
                    <li>
                        <a href="blog-full-width.html">Blog Full Width</a>
                    </li>
                    <li>
                        <a href="blog-details.html">Blog Details</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="contact.html">Contact</a>
            </li>
            <li><a href="#">Account</a>
                <ul class="dropdown">
                    <li><a href="login-form.html">My Account</a></li>
                    <li><a href="wishlist.html">My Wishlist</a></li>
                    <li><a href="compare.html">Compare</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li><a href="login.html">Log In</a></li>
                    <li><a href="register.html">Create an account</a></li>
                    <li><a href="#">close</a></li>
                </ul>
            </li>
        </ul>

    </nav>
</div>