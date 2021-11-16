@extends('Frontend.Layout.app')
    @push('head-scripts')
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

    <style>
        #css-dropdown
        {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            width: 300px;
            height: 42px;
            margin: 100px auto 0 auto;
        }

        .choices__inner{
            border-radius:10px;
            min-height:40px !important;
        }
    </style> 
    @endpush
@section('content')

    <?php  
        use App\Models\jobname;
        $jobs=jobname::get(['id', 'type']);
    ?>

<section class="section-two">
   <div class="container">
   @if(Illuminate\Support\Facades\Auth::check())
    <form action="employee_post" method="post" id="myform" enctype="multipart/form-data">
      @csrf
       <div class="row">
           <div class="col-md-12 text-center">
               <h1 class="fs-22 text-white mgb-20">FOR EMPLOYEES</h1>
           </div> 
           <div class="col-md-6">
                <div class="row employees d-flex justify-content-center mt-100">
                    <div class="col-md-11">
                        <label class="primary_color fw-bold fs-15 mgb-10">Enter Your Role</label>
                        <select id="choices-multiple-remove-button1" required  class="form-control" name="role[]" placeholder="Select up to 5 tags" multiple>>
                            @foreach($jobs as $jobname)
                                <option value="{{$jobname->type}}">{{$jobname->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
           </div>
           <div class="col-md-6">
                <div class="employees">
                        <label class="primary_color fw-bold fs-15 mgb-10">Upload your Resume</label>
                        <input type="file" required name="resume" placeholder="Upload your resume....." class="form-control">
                    
                </div>
           </div>
           <div class="col-md-12 my-4 text-center">
               <button class="btn btn-primary btn-lg fw-bold fs-15" type="submit">SUBMIT RESUME</button>
           </div>
       </div>
    </form>
   @else
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
               <h1 class="fs-22 text-white mgb-20">FOR EMPLOYEES UPLOAD RESUME</h1>
            </div> 
            <div class="mx-auto" style="width:auto; justify-content: center; align-items: center; height:130px;">
                <div class="user mt-2" style="margin-left: -20px;">
                    <a href="auth/google">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                    </a>
                </div>
            </div>
        </div>
    </div>
   @endif


   </div>
  </section>
  <section class="section-three my-4">
      <div class="container">
          <div class="row">
              <div class="col-md-12 text-center">
                  <h1 class="fs-20">Smart Solutions for your Job Requirements</h1>
                  <hr class="hr">
              </div>
              <div class="col-md-4 my-4 text-center">
                 <div>
                    <div class="tick">
                        <img src="frontend-assets/images/first_tick.png" alt="" style="width: 100% !important;">
                    </div>
                    <h1 class="fs-20 my-3">Best</h1>
                    <p class="medium_color fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                 </div>
              </div>
              <div class="col-md-4 my-4 text-center">
                <div>
                   <div class="tick">
                       <img src="frontend-assets/images/second_tick.png" alt="" style="width: 100% !important;">
                   </div>
                   <h1 class="fs-20 my-3">Secure</h1>
                   <p class="medium_color fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                </div>
             </div>
             <div class="col-md-4 my-4 text-center">
                <div>
                   <div class="tick">
                       <img src="frontend-assets/images/thrid_tick.png" alt="" style="width: 100% !important;">
                   </div>
                   <h1 class="fs-20 my-3">Reliable</h1>
                   <p class="medium_color fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                </div>
             </div>
          </div>
      </div>
  </section>
  <section class="section-four">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <h1 class="fs-22 text-center"> For Employers</h1>
                   <hr class="hr"  style="width: 9% !important;">
               </div>
               <div class="col-md-12">
               
                    <form  id="myform1"  style="width: 50% !important;margin: auto;">
                        @csrf
                        <div class="form-group my-2">
                            <label for="employers_name" class="my-2 fs-15">Name</label>
                            <div class="col-md-12">
                                <input type="text" value="{{old('name')}}" class="form-control input" id="employers_name" name="name" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <label for="employers_email" class="my-2 fs-15">Email Id</label>
                            <div class="col-md-12">
                                <input type="email" value="{{old('email')}}" class="form-control input" id="employers_email" name="email" placeholder="Enter Email Id">
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <label for="employers_skill" class="my-2 fs-15">Skill Set</label>
                        </div>

                            <section>
                            <div class="row d-flex justify-content-center mt-100">
                                <div class="col-md-11">
                                    <select id="choices-multiple-remove-button" class="form-control" name="skill[]" placeholder="Select up to 5 tags" multiple>>
                                        @foreach($jobs as $jobname)
                                        <option value="{{$jobname->type}}">{{$jobname->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            </section>
                        <div class="text-center my-4 form-group">
                            <button class="btn btn-submit" type="submit">Submit</button>
                        </div>
                   </form>
               </div>
           </div>
       </div>
  </section>
@endsection
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'></script>



  <script>
      $(document).ready(function(){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
        });
    });


    $(document).ready(function(){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button1', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
        });
    });
  </script>

<script>
    $(document).ready(function() {
        $('#myform1').on('submit', function(event) {
            event.preventDefault();
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right"
            };
            $('.loader').show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('Employer') }}",
                method: "post",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if(response.error){
                        toastr.error(response.error);
                    }
                    if(response.success){
                        toastr.success(response.success);
                    }
                },
                complete: function() {
                    $('.loader').hide();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        toastr.error(error);
                    })
                }
            });

        });
    });
</script>




