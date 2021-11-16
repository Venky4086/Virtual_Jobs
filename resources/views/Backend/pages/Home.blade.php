@extends('Backend.layout.app')
@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">

        <div class="container mt-3 allbooking">
    <h3 class="text-center">Dashboard Overview</h3>
    <div class="row mt-2">
        <div class="four col-md-3" >
            <div class="counter-box" style="background-color:#20bf55;
background-image :linear-gradient(315deg, #20bf55 0%, #01baef 74%);
"> <i class="fa fa-list" aria-hidden="true"></i>
             <span class="counter">25</span>
                <p>Registed Employees</p>
            </div>
        </div>
        <div class="four col-md-3">
            <div class="counter-box" style="background-color: #90d5ec;
background-image: linear-gradient(315deg, #90d5ec 0%, #fc575e 74%);
"><i class="fa fa-check" aria-hidden="true"></i>
           <span class="counter">10</span>
                <p>Register Employers</p>
            </div>
        </div>
        <div class="four col-md-3">
            <div class="counter-box" style="background-color: #fce043;
background-image: linear-gradient(315deg, #fce043 0%, #fb7ba2 74%);"> <i class="fa fa-pause" aria-hidden="true"></i>
             <span class="counter">32</span>
                <p>Received Resumes</p>
            </div>
        </div>
        <div class="four col-md-3">
            <div class="counter-box" style="background-color: #537895;
background-image: linear-gradient(315deg, #537895 0%, #09203f 74%);"> <i class="fa fa-ban" aria-hidden="true"></i>
                 <span class="counter">28</span>
                <p>Total Cancelled</p>
            </div>
        </div>
    </div>
</div>



        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2020 Prashanth goud. All rights reserved. <a href="">Prashanth</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@stop
