<!-- jquery
		============================================ -->
<script src="{{asset("source/admin/js/vendor/jquery-1.12.4.min.js")}}"></script>
<!-- bootstrap JS
		============================================ -->
<script src="{{asset("source/admin/js/bootstrap.min.js")}}"></script>

<!-- meanmenu JS
		============================================ -->
<script src="{{asset("source/admin/js/jquery.meanmenu.js")}}"></script>

<!-- mCustomScrollbar JS
		============================================ -->
<script src="{{asset("source/admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js")}}"></script>
<script src="{{asset("source/admin/js/scrollbar/mCustomScrollbar-active.js")}}"></script>
<!-- metisMenu JS
		============================================ -->
<script src="{{asset("source/admin/js/metisMenu/metisMenu.min.js")}}"></script>
<script src="{{asset("source/admin/js/metisMenu/metisMenu-active.js")}}"></script>
<!-- sparkline JS
		============================================ -->
<script src="{{asset("source/admin/js/sparkline/jquery.sparkline.min.js")}}"></script>
<script src="{{asset("source/admin/js/sparkline/jquery.charts-sparkline.js")}}"></script>
<!-- calendar JS
		============================================ -->
<script src="{{asset("source/admin/js/calendar/moment.min.js")}}"></script>
<script src="{{asset("source/admin/js/calendar/fullcalendar.min.js")}}"></script>
<script src="{{asset("source/admin/js/calendar/fullcalendar-active.js")}}"></script>
	<!-- float JS
		============================================ -->
<script src="{{asset("source/admin/js/flot/jquery.flot.js")}}"></script>
<script src="{{asset("source/admin/js/flot/jquery.flot.resize.js")}}"></script>
<script src="{{asset("source/admin/js/flot/curvedLines.js")}}"></script>
<script src="{{asset("source/admin/js/flot/flot-active.js")}}"></script>
<!-- plugins JS
		============================================ -->
<script src="{{asset("source/admin/js/plugins.js")}}"></script>
<!-- main JS
		============================================ -->
<script src="{{asset("source/admin/js/main.js")}}"></script>
<!-- notification JS
		============================================ -->
<script src="{{asset("source/admin/js/notifications/notification.js")}}"></script>

<script>
    /* Start Notification Js*/
    @if($errors->any())
        @foreach($errors->all() as $error)
            Toastr({ type:"error", title:"Error", message:"{{$error}}",delay:2000 })
        @endforeach
    @endif
	@if(session("success"))
		Toastr({ type:"success", title:"Success", message:"{{session('success')}}",delay:2000 })
	@endif
</script>
@yield('js')