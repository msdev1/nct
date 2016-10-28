@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if (\Session::has('msg'))
                  <p>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     @foreach (\Session::get('msg') as $e)

                      <small>{{ $e }}</small><br>

                    @endforeach

                    </div>

                  @else
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
