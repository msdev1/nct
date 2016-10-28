@extends('layouts.plate')
@section('Title', 'Backend :Control Panel')


<?php 
$data['path']=[
'Home'=>action('\\Backend\\SystemController@index'),
'Website'=>'active'
];
$dy='dy';
$od='od';
$bod='bod';
$sob='sob';

$subM=[
'basic'=>$dy."_basic",
'od'=>$dy."_od",
'bod'=>$dy."_bod",
'sob'=>$dy."_sob",
];
$tabId['basic']=$dy.'_basic';
$tabId=[
$dy=>['basic'=>$tabId['basic'],
'edit'=>$tabId['basic'].'_edit',
'batch'=>$tabId['basic'].'_batch',],
$od=>[
'basic'=>$subM['od'],
'edit'=>$subM['od'].'_edit',
'batch'=>$subM['od'].'_batch',
],
$bod=>[
'basic'=>$subM['bod'],
'edit'=>$subM['bod'].'_edit',
'batch'=>$subM['bod'].'_batch',
],
$sob=>[
'basic'=>$subM['sob'],
'edit'=>$subM['sob'].'_edit',
'batch'=>$subM['sob'].'_batch',
],
];
///dd($tabId);

?>
@section('content')
@include('layouts.Backend.Dynamic.nav',['data' => $data])
<div class="container panel panel-default">
<div class="panel-body">
<ul class="nav nav-tabs" role="tablist">
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Basic Setting"  > <a href="#{{$tabId[$dy]['basic']}}" aria-controls="{{$tabId[$dy]['basic']}}" role="tab" data-toggle="tab" class="bg-warning">Basic Settings</a></li>
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Organization Details"  > <a href="#{{$tabId[$od]['basic']}}" aria-controls="{{$tabId[$od]['basic']}}" role="tab" data-toggle="tab" class="bg-warning">Organization Details</a></li>
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Board of Directors"  > <a href="#{{$tabId[$bod]['basic']}}" aria-controls="{{$tabId[$bod]['basic']}}" role="tab" data-toggle="tab" class="bg-warning">Board of Directors</a></li>
    <li  role="presentation" data-toggle="tooltip"  data-placement="top" title="Structure of Board"  > <a href="#{{$tabId[$sob]['basic']}}" aria-controls="{{$tabId[$sob]['basic']}}" role="tab" data-toggle="tab" class="bg-warning">Structure of Board</a></li>
    </ul>
</div>
  <!-- Tab panes -->
  <div class="tab-content ">
    <div role="tabpanel" class="tab-pane" id="{{$tabId[$dy]['basic']}}">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a class="bg-success"  href="#{{$tabId[$dy]['edit']}}" aria-controls="{{$tabId[$dy]['edit']}}" role="tab" data-toggle="tab">Edit</a></li>
        <li role="presentation"  ><a class="bg-success" href="#{{$tabId[$dy]['batch']}}" aria-controls="{{$tabId[$dy]['batch']}}" role="tab" data-toggle="tab">View</a></li>
        
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$dy]['edit']}}" action="{{ action('\Backend\Modules\DY\BasicSettings\MainController@save') }}">
          @include('Backend.Panel.Modules.DY.BasicSettings.edit')
        </div>
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$dy]['batch']}}" action="{{ action('\Backend\Modules\DY\BasicSettings\MainController@batchRefresh') }}">
         @include('Backend.Panel.Modules.DY.BasicSettings.batch')
        </div>
       
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="{{$tabId[$od]['basic']}}">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a class="bg-success"  href="#{{$tabId[$od]['edit']}}" aria-controls="{{$tabId[$od]['edit']}}" role="tab" data-toggle="tab">Edit</a></li>
        <li role="presentation"  ><a class="bg-success" href="#{{$tabId[$od]['batch']}}" aria-controls="{{$tabId[$od]['batch']}}" role="tab" data-toggle="tab">View</a></li>
        
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$od]['edit']}}" action="/backend/panel/config/module/api/add">
          @include('Backend.Panel.Modules.DY.OrganizationDetails.edit')
        </div>
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$od]['batch']}}">
         @include('Backend.Panel.Modules.DY.OrganizationDetails.batch')
        </div>
       
      </div>
    </div>
     <div role="tabpanel" class="tab-pane" id="{{$tabId[$bod]['basic']}}">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" ><a class="bg-success"  href="#{{$tabId[$bod]['edit']}}" aria-controls="{{$tabId[$bod]['edit']}}" role="tab" data-toggle="tab">Edit</a></li>
        <li role="presentation"  ><a class="bg-success" href="#{{$tabId[$bod]['batch']}}" aria-controls="{{$tabId[$bod]['batch']}}" role="tab" data-toggle="tab">View</a></li>
        
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$bod]['edit']}}" action="/backend/panel/config/module/api/add">
          @include('Backend.Panel.Modules.DY.StructureBoard.edit')
        </div>
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$bod]['batch']}}">
         @include('Backend.Panel.Modules.DY.StructureBoard.batch')
        </div>
       
      </div>
    </div>
     <div role="tabpanel" class="tab-pane" id="{{$tabId[$sob]['basic']}}">
      <ul class="nav nav-tabs" role="tablist">
        
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$sob]['edit']}}" action="/backend/panel/config/module/api/add">
          @include('Backend.Panel.Modules.DY.StructureBoard.edit')
        </div>
        <div role="tabpanel" class="tab-pane" id="{{$tabId[$sob]['batch']}}">
         @include('Backend.Panel.Modules.DY.StructureBoard.batch')
        </div>
       
      </div>
    </div>
    </div>
    </div>

    @endsection

@push('js')

<?php
$mod='';
if($data['request']->has('mod')){
$mod=strtolower($data['request']->input('mod'));
}

if($data['request']->has(['mainTab'])){
$js='$( "#'.$mod."_".$data['request']->input('mainTab').'" ).addClass( "active" );';
$selector="[href=#".$mod."_".$data['request']->input('mainTab')."]";
$js.='$( "'.$selector.'" ).closest("li").addClass( "active" );';
if($data['request']->has(['subTab'])){
$selector2="[href=#".$mod."_".$data['request']->input('mainTab')."_".$data['request']->input('subTab')."]";
$js.='$( "'.$selector2.'" ).closest("li").addClass( "active" );';
$selector3=$data['request']->input('mainTab')."_".$data['request']->input('subTab');
$js.='$( "#'.$mod."_".$selector3.'" ).addClass( "active" );';
}
echo $js;
}



 ?>


$('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover',
    delay : { show: '5000', hide: '3000' }
});

$('[data-toggle="tooltip"]').on('click', function () {
  $(this).tooltip('hide');
});




 @endpush
