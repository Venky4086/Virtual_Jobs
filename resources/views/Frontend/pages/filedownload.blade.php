@extends('Frontend.Layout.app')
@section('content')
    <section class="container">
        <div class="card col-md-8 mx-auto mb-4">
            @if($details)
                <div class="card-header text-center">
                    <h4>Resumes matched with your requirement</h4>
                </div>
                <div class="card-body m-5">
                    <div class="row">
                    @foreach($details as $key=> $d)
                        <div class="col-md-4 text-center">
                            <a href="{{asset('')}}{{$d->resume}}" download>
                                <button class="btn btn-success"><i class="fa fa-download"></i> &nbsp; Download</button>
                            </a>
                            <h6 class="mt-2"> Resume- {{$key+1}}</h6>
                        </div>
                    @endforeach
                    </div>
                </div>
            @else
            <div class="card-header text-center">
                <h4>Sorry no Resumes matched with your requirement</h4>
            </div>
            @endif
        </div>
    </section>
@endsection
