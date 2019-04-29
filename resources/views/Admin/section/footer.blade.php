</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/panel.js"></script>
<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jscolor.js') }}"></script>
<script type="text/javascript" src="{{ url('js/js.cookie.js') }}"></script>
<script>
    $(".nav-link").on('shown.bs.collapse', function ()
    {
        var active = $(this).attr('id');
        $.cookie('activePanelGroup', active);
    });

    $(".nav-link").on('hidden.bs.collapse', function ()
    {
        $.removeCookie('activePanelGroup');
    });

    var last = $.cookie('activePanelGroup');
    if (last != null)
    {
        //remove default collapse settings
        $(".nav-link").removeClass('in');
        //show the account_last visible group
        $("#" + last).addClass("in");
    }
</script>
@yield('footer')
<script>
    feather.replace()
</script>



