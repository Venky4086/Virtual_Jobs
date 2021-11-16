@extends('Frontend.Layout.app')
@section('content')
<section class="section-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-xs-7 col-sm-7 my-5 d-flex justify-content-center">
                <div style="width: 450px;margin: auto;">
                    <img src="frontend-assets/images/second_group_image1.jpeg" alt="group-image" style="width: 100%;" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-xs-5 col-sm-5 my-5">
                <div class="job_holder">
                    <h1 class="primary_color fs-20 text-center">10,000 Job holder are successfuly working by</h1>
                    <h1 class="primary_color fs-20 text-center fw-700">VIRTUALJOBS.IN</h1>
                    <hr class="primary_color my-5" style="opacity: 1 !important;">
                    <h1 class="text-danger fs-20 text-center">All the resumes are not verified,</h1>
                    <h1 class="fs-20 text-danger text-center">Verification process should</h1>
                    <h1 class="fs-20 text-danger text-center">be done by the Employees</h1>
                    <p class="primary_color fs-13 fw-700 text-center">On clicking  submit button</p>
                    <p class="primary_color fs-13 fw-700 text-center">you will receive two resumes of the employees</p>
                    <p class="text-center primary_color fs-13 fw-700">to your email ID</p>
                    <div class="text-center my-4 form-group">
                        <a href="searching"><button class="btn btn-submit" type="button">Submit</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop