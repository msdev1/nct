@extends('layouts.plate')

@section('Title')
{{$data['web']['SiteTitle']}}
@endsection

@push('keywords')
{{$data['web']['Keywords']}}
@endpush


@section('content')


@include('layouts.Frontend.Dynamic.nav')


<div class="mainPanel">
    
</div>
<footer class="navbar navbar-default navbar-fixed-bottom"><div class="container text-center">© {{$data['web']['CopywriteText']}} </div></footer>

@endsection
