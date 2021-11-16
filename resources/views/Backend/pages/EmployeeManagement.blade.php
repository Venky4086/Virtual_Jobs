@extends('Backend.layout.app')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
      <div class="row">
          <div class="col-md-4 mt-3">
            <h5 style="margin-left:20px; font-size:1.2rem !important">Employees List</h5>
          </div>
          <div class="col-md-4 mt-3">
            <input type="text" class="search form-control" placeholder="Search">
            <span class="counter"></span>
          </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-11 px-2">
          <div class="table-responsive w-100" style="height:500px;">
            <table class="table table-hover results table-sm m-auto">
              <thead class="bg- text-white text-center" style="background-color: #0cbaba;
                  background-image: linear-gradient(315deg, #0cbaba 0%, #380036 74%); border-radius:10px;">
                <tr style="height:8px !important;">
                  <th>SNO</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Employee Skills</th>
                  <th>Resumes</th>
                </tr>
              </thead>
              <tbody style="background-color:white;" class="text-center">
                @foreach($data as $emp)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$emp->name}}</td>
                      <td>{{$emp->email}}</td>
                      <td>{{$emp->role}}</td>
                      <td><a download href="{{$emp->resume}}"><i class="fa fa-cloud-download" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $data->links( "pagination::bootstrap-4") }}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@stop