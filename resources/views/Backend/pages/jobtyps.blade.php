@extends('Backend.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="card ml-5 mr-5">
            <div class="row">
                <div class="col-md-4 offset-1">
                    <form action="{{route('post_jobstype')}}" method="post" enctyp="mutlipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="jobs">Job Type</label>
                            <input type="text" required class="form-control" name="jobs">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <!-- <div class="col-md-4 offset-1">
                    <form action="{{route('post_jobstype')}}" method="post" enctyp="mutlipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="jobs">Job Type</label>
                            <input type="text" required class="form-control" name="jobs">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
        <div class="col-md-6 offset-3 mt-5">
                <h6>All Job Types</h6>
            <div class="table">
                <table class="table table-responsive">
                    <thead>
                        <th>SNO</th>
                        <th>Job Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$job->type}}</td>
                            <td><a href="{{route('deletejob', ['id'=>$job->id])}}"><i class="fa fa-trash text-danger"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection