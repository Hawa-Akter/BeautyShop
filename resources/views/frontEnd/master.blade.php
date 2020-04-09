@include('frontEnd.includes.header')

@include('frontEnd.includes.navbar')

@yield('content')

@include('frontEnd.includes.footer')
@yield('additionalScript')
@include('frontEnd.includes.footerScript')