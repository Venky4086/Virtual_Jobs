


<html>

<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!------ Include the above in your HEAD tag ---------->
    <style>
    body#LoginForm {
        background-image: url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        padding: 10px;
    }

    .form-heading {
        color: #fff;
        font-size: 23px;
    }

    .panel h2 {
        color: #444444;
        font-size: 18px;
        margin: 0 0 8px 0;
    }

    .panel p {
        color: #777777;
        font-size: 14px;
        margin-bottom: 30px;
        line-height: 24px;
    }

    .login-form .form-control {
        background: #f7f7f7 none repeat scroll 0 0;
        border: 1px solid #d4d4d4;
        border-radius: 4px;
        font-size: 14px;
        height: 50px;
        line-height: 50px;
    }

    .main-div {
        background: #ffffff none repeat scroll 0 0;
        border-radius: 20px;
        margin: 10px auto 30px;
        max-width: 38%;

        padding: 40px 40px 40px 41px;
    }

    .login-form .form-group {
        margin-bottom: 10px;
    }

    .login-form {
        text-align: center;
    }

    .forgot a {
        color: #777777;
        font-size: 14px;
        text-decoration: underline;
    }

    .login-form .btn.btn-primary {
        background: #f0ad4e none repeat scroll 0 0;
        border-color: #f0ad4e;
        color: #ffffff;
        font-size: 14px;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0;
    }

    .forgot {
        text-align: left;
        margin-bottom: 30px;
    }

    .botto-text {
        color: #ffffff;
        font-size: 14px;
        margin: auto;
    }

    .login-form .btn.btn-primary.reset {
        background: #ff9900 none repeat scroll 0 0;
    }

    .back {
        text-align: left;
        margin-top: 10px;
    }

    .back a {
        color: #444444;
        font-size: 13px;
        text-decoration: none;
    }

    </style>
</head>

<body id="LoginForm">
    <div class="container">
        <h1 class="form-heading"></h1>
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Jobs Admin Login</h2>
                    <img style="height:100px;" src="admin.png" alt="">
                </div>
                <form id="Login" method="post" action="{{route('adminauthcheck')}}">
                    @csrf
                    <div class="form-group">


                        <input type="email" name="email" class="form-control" id="inputEmail"
                            placeholder="Email Address">

                    </div>

                    <div class="form-group">

                        <input type="password" name="password" class="form-control" id="inputPassword"
                            placeholder="Password">

                    </div>
                    <div class="forgot">
                        <a href="">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>

                </form>
            </div>
            <p class="botto-text"> Designed by Prashanth Goud</p>
        </div>
    </div>
    </div>


    @if (Session::has('success'))
    <script>
        toastr.success("<?php echo Session::get('success') ?>");
    </script>
    @elseif (Session::has('error'))
    <script>
        toastr.error("<?php  echo Session::get('error') ?>");
    </script>
    @endif

</body>

</html>
