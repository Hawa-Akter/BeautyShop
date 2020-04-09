<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.uideck.com/items/shopr-theme/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Aug 2018 10:59:11 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ecommerce">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('assets/')}}/img/favicon.png">

    <link rel="stylesheet" href="{{asset('assets/')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/')}}/css/bootstrap-select.min.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/fonts/font-awesome.min.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/fonts/line-icons/line-icons.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/css/main.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/settings.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/animate.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/')}}/extras/owl.theme.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/ion.rangeSlider.css" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/')}}/extras/ion.rangeSlider.skinFlat.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/component.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/slick.css" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/')}}/extras/slick-theme.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/extras/nivo-lightbox.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/css/color-switcher.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/css/slicknav.css" type="text/css">

    <link rel="stylesheet" href="{{asset('assets/')}}/css/responsive.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('star-rating-view/')}}/src/css/star-rating-svg.css">
    <link rel="stylesheet" type="text/css" href="{{asset('star-rating-view')}}/demo/css/demo.css">
    @yield('extraCss')
    <script>
        function sameFormData() {

            var name=document.getElementById('name').value;
            var email=document.getElementById('email').value;
            var add1=document.getElementById('add1').value;
            var add2=document.getElementById('add2').value;
            var postcode=document.getElementById('postCode').value;
            var city=document.getElementById('city').value;
            var phone=document.getElementById('phone').value;
            var state=document.getElementById('state').value;
            document.getElementById('nname').value=name;
            document.getElementById('nemail').value=email;
            document.getElementById('nadd1').value=add1;
            document.getElementById('nadd2').value=add2;
            document.getElementById('ntown').value=city;
            document.getElementById('npostCode').value=postcode;
            document.getElementById('nphone').value=phone;
            document.getElementById('state').value=state;
        }
    </script>
</head>
<body>