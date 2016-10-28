@extends('layouts.plate')
@section('Title', 'Backend :Control Panel')



@section('content')
<div class="navbar navbar-default navbar-fixed-top " role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a target="_blank" href="/backend" class="" ><img class="" style="max-height:40px;" src="{{asset('images/client/msdyna_logo_small_squar.png')}}" alt="Test Image" /></a>
        </div>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
        </ul>

            </ul>
        </div>
    </div>


</div>

<div class="container" style="padding-top:60px;">
  <ol class="breadcrumb container-fluid">
  <li><a href="/backend/panel">Home</a></li>
  <li class="active">Error</li>
  <li class="active">503</li>

  </ol>

<div class="panel">

  <div class="panel-body">
    <center>
      <i class="fa fa-exclamation-circle icon-size text-warning" aria-hidden="true"><br>ERROR 503</i><br>
      <h1 class="text-danger"><i class="fa fa-minus-circle" aria-hidden="true"></i> Under Maintaince Please Try again later <i class="fa fa-minus-circle" aria-hidden="true"></i></h1></center>
  </div>

 <div class="panel-footer">
   <div class="btn-group btn-group-justified" role="group" aria-label="...">
    <a class="btn-group" role="group" href="/backend/panel"> <button type="button" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i> Go Back</button></a>

   </div>
 </div>
 </div>
@endsection
