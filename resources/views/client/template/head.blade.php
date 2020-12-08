<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mạng xã hội sinh viên CTU | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/images/logo-ctu.png')}}" />
    <!-- Bootstrap Core CSS -->

    <link href="{{asset('client/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('client/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('client/css/patros.css')}}">

    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    {{-- upload file --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css"
        media="all" type="text/css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        .navbar-brand img {
            margin-top: -15px;
            height: 55px;
        }

        .borderless td {
            border: none !important;
        }

        .btn-ctu {
            background-color: #2f9de3;
            color: white;
        }

        .text-right td {
            text-align: right;
        }

        .alert {
            padding: 0px;
            padding-left: 15px;
        }

        .alert p {
            display: table-cell;
            padding: 5px 0;
            vertical-align: middle;
        }

        ul.brcmp {
            margin: 0;
            padding: 0;
            display: inline-flex;
            font-size: 20px;
        }

        .blog-title {
            font-size: 20px;
        }

        input#search {
            width: auto;
        }
        .gioithiu {
    text-transform: capitalize;
    color: #3471ad;
    font-size: 14px;
}
button.btn.btn-ctu {
    margin-top: 15px;
}
    </style>
    @stack('css')
</head>
