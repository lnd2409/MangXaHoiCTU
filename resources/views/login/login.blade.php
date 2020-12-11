<!DOCTYPE html>
<html lang="en">

<head>
    <title>CTU - Mạng xã hội sinh viên trường ĐHCT</title>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- logo ctu --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/images/logo-ctu.png')}}" />
    <!-- //Meta tags -->
    <link rel="stylesheet" href="{{asset('login/css/style.css')}}" type="text/css" media="all" /><!-- Style-CSS -->
    <link href="{{asset('login/css/font-awesome.css')}}" rel="stylesheet"><!-- font-awesome-icons -->
    <link href="{{asset('client/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('client/css/patros.css')}}"> --}}
    <style>
        .alert {
            color: red;
        }

        .navbar-brand img {
            height: 55px;
        }

        nav {
            margin-bottom: 0px;
            background-color: #3571ad;
            opacity: 0.85;
        }

        div#navbarNavDropdown {
            padding: 10px 0;
        }

        .navbar {
            border-radius: 0px !important;
            margin-bottom: 0;
            min-height: 10vh;
        }

        section {}

        .form-36-mian {
            min-height: 90vh;
            padding: 0;
        }

        body {
            height: 100vh !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-0">
        <div class="container">

            <a class="navbar-brand"><img src="{{asset('client/images/logo-ctu.png')}}" alt="company logo" /></a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li style="color:white">
                        <h4>
                            <strong>

                                TRƯỜNG ĐẠI HỌC CẦN THƠ
                            </strong>
                        </h4>
                        <p style="color:white"><strong>Mạng xã hội sinh viên</strong></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand"><img src="{{asset('client/images/logo-ctu.png')}}" alt="company logo" /></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left custom-menu">
            <li style="color:white">
                <h4>
                    <strong>

                        Trường đại học cần thơ
                    </strong>
                </h4>
                <p style="color:white"><strong>Mạng xã hội sinh viên</strong></p>
            </li>
        </ul>
    </div>
    </div>

    </nav> --}}


    <section class="w3l-form-36">
        <div class="form-36-mian section-gap">
            <div class="wrapper">

                <div class="form-inner-cont">
                    <div class="panel-heading text-center">
                        <h3>Đăng nhập</h3>
                    </div>
                    <form action="{{route('login')}}" method="post" class="signin-form">
                        @csrf
                        <div class="form-input">
                            <span class="fa fa-envelope-o" aria-hidden="true"></span>
                            <input type="text" name="code" placeholder="MSSV" required />
                        </div>
                        <div class="form-input">
                            <span class="fa fa-key" aria-hidden="true"></span> <input type="password" name="password"
                                placeholder="Mật khẩu" required />
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <br>


                        <div class="login-remember d-grid">
                            <label class="check-remaind">
                                {{-- @include('vendor.bone.captcha.image') --}}
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                                <p class="remember">Ghi nhớ đăng nhập</p>
                            </label>
                           
                           
                            <button class="btn theme-button">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>