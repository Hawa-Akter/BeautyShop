@include('backend.Includes.header')
<div class="wrapper">
    @include('backend.Includes.navbar')
    @yield('content')
</div>


@yield('script')
<script src="{{asset('AdminAssets/')}}/js/jquery.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery-ui.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/perfect-scrollbar.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery.sparkline.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/raphael.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/morris.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/select2.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery-jvectormap.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery-jvectormap-world-mill.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/horizontal-timeline.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/jquery.steps.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/dropzone.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/ion.rangeSlider.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/datatables.min.js"></script>
<script src="{{asset('AdminAssets/')}}/js/main.js"></script>
</body>
<!-- Mirrored from themelooks.net/demo/dadmin/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Aug 2018 11:23:34 GMT -->
</html>