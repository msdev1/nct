@extends('layouts.plate')
@section('Title', 'Backend :Login')


@section('content')

<div style="margin-top:4%;" class="jumbotron col-xs-10 col-sm-10 col-md-4 col-lg-4 col-xs-offset-1 col-sm-offset-1 col-md-offset-4 col-lg-offset-4">
  <center><div class="">
<img class="logo" src="{{asset('images/client/msdyna_logo_small_squar.png')}}" alt="Test Image" />
</div><br><h4 >Login to Control Panel</h4></center>

  <hr >
  @if (\Session::has('error'))
  <p>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     @foreach (\Session::get('error') as $e)

      <small>{{ $e }}</small><br>

    @endforeach

    </div>
</p>
  @endif

  <p>
    @if(\Session::has('form'))
    <?php \Session::get('form')->loginForm(true); ?>

    @elseif (isset($form))
    <?php $form->loginForm(true); ?>
    @else

    Error in Dynamic Form Setcion {{ __FILE__ }}
    @endif
  </p>



</div>
<div class="container-fluid">
<img class="logo col-xs-10 col-sm-10 col-md-2 col-lg-2 col-xs-offset-1 col-sm-offset-1 col-md-offset-5 col-lg-offset-5 " src="{{asset('images/master/powerby2.png')}}" alt="Test Image" />
 </div>
@endsection
