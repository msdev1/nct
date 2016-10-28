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
             <ul class="nav navbar-nav navbar-right">
      
               @include('layouts.Backend.Dynamic.user', ['user' => $data['user']])
             </ul>
         </div>
     </div>


 </div>
 <div class="container" style="padding-top:60px;">
   <ol class="breadcrumb container-fluid">
  <li><a href="/backend/panel">Home</a></li>
  <li class="active">Configure</li>

</ol>
   <div class="panel panel-default ">

     <div>
<div class="panel">
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
</div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Modules Setting"  > <a href="#module" aria-controls="module" role="tab" data-toggle="tab">Module</a></li>
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Users Setting"><a  href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a></li>
    <li role="presentation"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Settings</a></li>
    <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact Details</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="module">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a href="#module_add" aria-controls="module_add" role="tab" data-toggle="tab">Add</a></li>
        <li role="presentation"><a href="#module_edit" aria-controls="module_edit" role="tab" data-toggle="tab">Edit</a></li>

        <li role="presentation"><a href="#module_view" aria-controls="module_view" role="tab" data-toggle="tab">View/Edit/Delete</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="module_add" action="/backend/panel/config/module/api/add">
          @include('Backend.Panel.Configure.Modules.addModuleForm')
        </div>
        <div role="tabpanel" class="tab-pane" id="module_edit">
          @include('Backend.Panel.Configure.Modules.editModuleForm')
        </div>
       <div role="tabpanel" class="tab-pane" id="module_view" action="/backend/panel/config/module/api/view">
          @include('Backend.Panel.Configure.Modules.viewModuleForm')
        </div>
      </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="user">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a href="#user_add" aria-controls="user_add" role="tab" data-toggle="tab">Add</a></li>
        <li role="presentation"><a href="#user_edit" aria-controls="user_edit" role="tab" data-toggle="tab">Edit</a></li>
        
        <li role="presentation"><a href="#user_view" aria-controls="user_view" role="tab" data-toggle="tab">View/Edit/Delete</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="user_add">
          @include('Backend.Panel.Configure.Users.addUserForm')
        </div>
        <div role="tabpanel" class="tab-pane" id="user_edit">
          @include('Backend.Panel.Configure.Users.editForm')
        </div>
       
        <div role="tabpanel" class="tab-pane" id="user_view">
          @include('Backend.Panel.Configure.Users.viewUsersForm')
        </div>
      </div></div>

    <div role="tabpanel" class="tab-pane" id="basic">.r..</div>

    <div role="tabpanel" class="tab-pane" id="contact">...</div>
  </div>

</div>



     <div class="panel-footer">
       <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <a class="btn-group" role="group" href="/backend/panel"> <button type="button" class="btn btn-primary"><i class="fa fa-step-backward" aria-hidden="true"></i> Go Back Panel</button></a>

       </div>
     </div>
</div>
</div>
@endsection
@push('js')

<?php

if($data['request']->has(['mainTab'])){
$js='$( "#'.$data['request']->input('mainTab').'" ).addClass( "active" );';
//$js=htmlentities($js,ENT_HTML5);
$selector="[href=#".$data['request']->input('mainTab')."]";

$js.='$( "'.$selector.'" ).closest("li").addClass( "active" );';


if($data['request']->has(['subTab'])){
$selector2="[href=#".$data['request']->input('mainTab')."_".$data['request']->input('subTab')."]";
$js.='$( "'.$selector2.'" ).closest("li").addClass( "active" );';
$selector3=$data['request']->input('mainTab')."_".$data['request']->input('subTab');
$js.='$( "#'.$selector3.'" ).addClass( "active" );';
}
//$selector='#'.$data['request']->input('mainTab').' a[href="#'.$data['request']->input('mainTab').'"]';

//$js="$('".$selector."').tab('show');";
//dd($js);
echo $js;
  //var_dump($js);
}
//var_dump($js);


 ?>
 @if (isset($js))

@endif

$('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover',
    delay : { show: '5000', hide: '3000' }
});

$('[data-toggle="tooltip"]').on('click', function () {
  $(this).tooltip('hide');
});




 @endpush
