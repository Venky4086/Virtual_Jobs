<!DOCTYPE html>
<html>
<head>
<title>job search</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('frontend-assets/css/style.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('frontend-assets/images/favicon.png') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('frontend-assets/images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
    }

    .dropdown:hover>.dropdown-menu {
  display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}

</style>
@stack('head-scripts')
</head>
<body>
<div class="loader"></div>
 
<section class="section-one my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-logo" style="float: left;">
                        <a href="/"><img src="{{asset('frontend-assets/images/virual.png')}}" alt="logo" class="logo img-fluid"></a>
                    </div>

                    

                    @if(Illuminate\Support\Facades\Auth::check())
                    <div class="user mt-4" style="float: right;">
                      <span>{{ Auth::user()->name }}</span> &nbsp;&nbsp;
                        <a href="userlogout" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-log-out"></span> Log out
                        </a>
                    </div>

                    
                    <!-- <div class="user mt-4" style="padding-left:200px;;">
                        <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Resumes
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                        </div>
                    </div> -->

                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 my-5">
                    <div>
                        <h1 class="warning_color fw-700">We are</h1>
                        <h1 class="primary_color fw-700">Hiring Virtual</h1>
                        <h1 class="primary_color fw-700">Employees</h1>
                        <p class="medium_color fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised.</p>
                    </div>
                </div>
                <div class="col-md-6 my-5">
                    <div>   
                        <img src="{{asset('frontend-assets/images/group-image.png')}}" alt="group-image" class="side1-image img-fluid">
                    </div>
                </div>
            </div>
        </div>
  </section>

  @yield('content')

  <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 my-2">
                <div class="d-flex justify-content-center">
                    <div class="footer-logo">
                        <img src="{{asset('frontend-assets/images/logo.png')}}" alt="footer_logo" class="footerlogo img-fluid">
                    </div>
                </div>
                <p class="text-white fs-13">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised
                </p>
            </div>
            <div class="col-md-3 my-2 d-flex justify-content-center">
                <div>
                    <h2 class="fs-22 text-white bdb-1 pdb-5 text-center">QUICK LINKS</h2>
                    <ul class="my-3 list-unstyled">
                        <li class="my-2 fs-15 text-white list-style-none"><i class="fa fa-circle fs-10 mgr-10"></i> <span class="fs-15 cursor-pointer"><a href="/" style="text-decoration:none; color:white">Home</a></span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle text-white fs-10 mgr-10"></i> <span>Jobs</span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>Govt Jobs</span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>Private Jobs</span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>Resumes</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 my-2 d-flex justify-content-center">
                <div>
                    <h2 class="fs-22 text-white bdb-1 pdb-5 text-center">SERVICES</h2>
                    <ul class="my-3 list-unstyled">
                        <li class="my-2 fs-15 text-white list-style-none cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i> <span class="fs-15"></span><a href="/" style="text-decoration:none; color:white">Home</a></span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle text-white fs-10 mgr-10"></i> <span>Jobs</span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>Govt Jobs</span></li>
                        <li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>Private Jobs</span></li>
                        <a href="{{route('web_privacy_policy')}}"><li class="my-2 fs-15 text-white cursor-pointer"><i class="fa fa-circle fs-10 mgr-10"></i><span>privacy policy</span></li></a>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 my-2 d-flex justify-content-center">
                <div>
                    <h2 class="fs-22 text-white bdb-1 pdb-5 text-center">CONTACT US</h2>
                    <ul class="my-3 list-unstyled">
                        <li class="my-2 fs-15 text-white list-style-none"></span>info@virtualjobs.com</span></li>
                        <li class="my-2 fs-15 text-white"><i class="fa fa-phone text-white fs-20 mgr-10"></i> <span>+40-52656623</span></li>
                        <li class="my-2 fs-15 text-white"><i class="fa fa-map-marker fs-20 mgr-10"></i><span>#250, New Jersey, VI</span></li>
                        <li class="my-2 fs-15 text-white"><i class="fa fa-location fs-10 mgr-10"></i><span>USA -52</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <ul class="list-unstyled d-flex">
                    <li class="text-white">
                        <i class="fa fa-facebook fs-20 mgr-25"></i>
                    </li>
                    <li class="text-white">
                        <i class="fa fa-twitter fs-20 mgr-25" aria-hidden="true"></i>
                    </li>
                    <li class="text-white">
                        <i class="fa fa-instagram fs-20" aria-hidden="true"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script>
        @if(isset($errors))
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        @endif
    </script>



    <script>
        @if(Session::has('success'))
            toastr.success("<?php echo Session::get('success') ?>");
        @elseif (Session::has('error'))
            toastr.error("<?php echo Session::get('error') ?>");
        @endif
    </script>

<script>
jQuery(document).ready(function() {
    jQuery('.loader').fadeOut();
});
</script>

<!-- <script>
    $(document).ready(function(){
    $("#myform1").on("submit", function(){
        $(".loader").fadeIn();
    });
    });
</script> -->


<script>
    $(document).ready(function(){
    $("#myform").on("submit", function(){
        $(".loader").fadeIn();
    });//submit
    });//document ready
</script>
</body>
</html>