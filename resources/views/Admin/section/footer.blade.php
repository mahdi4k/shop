</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="{{url('js/js-persian-cal.min.js')}}"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/panel.js"></script>
<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jscolor.js') }}"></script>

@yield('footer')
<script>
    feather.replace()
</script>

<script>
$('#click_advance,#click_advance1').click(function() {
    $('#display_advance').toggle('1000');
    $("i", this).toggleClass("fa fa-angle-up fa fa-angle-down");
});
</script>

