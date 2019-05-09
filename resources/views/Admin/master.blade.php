 <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        @yield('header')
    </title>


    <!-- Bootstrap core CSS -->
    <link href="/css/admin.css" rel="stylesheet">
    <link href="/css/js-persian-cal.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/admin-custom.css" rel="stylesheet">
@yield('style')
</head>

<body>




@include('Admin/section/header')
<main style="text-align: right" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 pull-left">

@yield('content')

</main>
@include('Admin/section/footer')



</body>
</html>
