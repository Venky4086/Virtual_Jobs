<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- bootstrap and jquery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- end bootsrap and jquery -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- external css -->
    <link href="backend-assets/css/main.css" rel="stylesheet">
    <!-- end external css -->

    <!-- external js -->
    <script src="backend-assets/js/main.js"></script>
    <!-- end extername js -->
    <style>
         .results tr[visible='false'],
        .no-result {
            display: none;
        }

        .results tr[visible='true'] {
            display: table-row;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" style="min-height:620px;">
            <div class="sidebar-header text-center" >
                <h3>Virtual Jobs</h3>
            </div>
            <ul class="list-unstyled components">
                <p class="text-center" style="background-color:#17A2B8">MENU</p>
                <li> <a href="dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}">  <i class="fa fa-tachometer" aria-hidden="true"></i> &nbsp; &nbsp; Dashboard</a> </li>
                <li> <a href="employee" class="{{ Request::is('employee') ? 'active' : '' }}"><i class="fa fa-id-card" aria-hidden="true"></i> &nbsp; &nbsp; Employees</a> </li>
                <li> <a href="employers" class="{{ Request::is('employers') ? 'active' : '' }}"> <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; &nbsp; Employers</a> </li>
                <li> <a href="get_requests" class="{{ Request::is('get_requests') ? 'active' : '' }}"> <i class="fa fa-times" aria-hidden="true"></i>&nbsp; &nbsp; Unmatched Skills</a> </li>
                <li> <a href="get_jobstype" class="{{ Request::is('get_jobstype') ? 'active' : '' }}"> <i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; &nbsp; Job Types</a> </li>

            </ul>
        </nav>
        <div class="content" style="width:100%">
            <nav class="navbar navbar-expand-lg navbar-light bg-light"> <button type="button" id="sidebarCollapse"
                    class="btn btn-info"> <i class="fa fa-align-justify"></i> </button> <button class="navbar-toggler"
                    type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li  class="nav-item active" style="background-color:#17A2B8; border-radius:5px;"> <a class="nav-link text-white" href="logout">Logout <span
                                    class="sr-only">(current)</span></a> </li>
                        
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper">


                
                <!-- Main Content -->
                @yield('content')
                <!-- end Content -->
                @if (Session::has('success'))
                <script>
                    toastr.success("<?php echo Session::get('success') ?>");
                </script>
                @elseif (Session::has('error'))
                <script>
                    toastr.error("<?php  echo Session::get('error') ?>");
                </script>
                @endif
            </div>
        </div>
    </div>
   

    <script>
         $(document).ready(function() {
            $(".search").keyup(function() {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

                $.extend($.expr[':'], {
                    'containsi': function(elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
                    $(this).attr('visible', 'false');
                });

                $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
                    $(this).attr('visible', 'true');
                });

                var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');

                if (jobCount == '0') {
                    $('.no-result').show();
                } else {
                    $('.no-result').hide();
                }
            });
        });
    </script>
</body>

</html>
