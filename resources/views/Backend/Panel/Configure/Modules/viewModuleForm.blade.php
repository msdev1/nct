<?php $data1=$data['form']->all(); ?>
<div id="moduleView_table" action="/backend/panel/config/module/api/view">
<?php



$table='<table class="table table-striped table-bordered">';
$table.='<tr>
<th>id</th>
<th>Module Name</th>
<th>Module Link</th>
<th>Module Code</th>
<th>Module Parent</th>
<th>Module Count</th>
<th class="text-center">Module Status</th>
<th class="text-center">Action</th>
</tr>';
foreach ($data1 as $value) {
  $status='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-danger disabled"><i class="fa fa-times" aria-hidden="true"></i></button></div>';
  if($value->Status==true){
    $status='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-success disabled"><i class="fa fa-check-square-o  " aria-hidden="true"></i></button></div>';
  }

  $form_prefix=\Form::open(array('action' =>'\Backend\PanelController@module_View','method' =>'delete','id'=>'actionForm_'.$value->id));
  $form_perfix= \Form::close();

  $form_prefix=\Form::open(array('action' =>'\Backend\PanelController@module_Edit','method' =>'delete','id'=>'actionForm_'.$value->id));
  $form_perfix= \Form::close();

  $form_prefix=\Form::open(array('action' =>'\Backend\PanelController@module_Delete','method' =>'delete','id'=>'actionForm_'.$value->id));
  $form_perfix= \Form::close();

  $action=
  '<input type="hidden" name="id" value="'.$value->id.'">'.
  '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
  <button class="btn btn-secondary btn-action btn-success " href="'.action("\Backend\PanelController@module_View",["id"=>$value->id]).'" ><i class="fa fa-eye  " aria-hidden="true"></i></button>
  <button class="btn btn-secondary btn-action btn-warning btn-act" href="'.action("\Backend\PanelController@module_Update_Form",["id"=>$value->id]).'"><i class="fa fa-pencil" aria-hidden="true"></i></button>
  <button class="btn btn-secondary btn-delete btn-danger" href="'.action("\Backend\PanelController@module_Delete",["id"=>$value->id]).'"><i class="fa fa-trash" aria-hidden="true"></i></button>
  </div>';

  $table.='<tr>';

  $table.='<td>'.$value->id.'</td>';
  $table.='<td>'.$value->ModuleName.'</td>';
  $table.='<td>'.$value->ModuleLink.'</td>';
  $table.='<td>'.$value->ModuleCode.'</td>';
  $table.='<td>'.$value->ModuleParent.'</td>';
  $table.='<td>'.$value->ModuleCount.'</td>';
  $table.='<td class="text-center">'.$status.'</td>';
  $table.='<td class="text-center">'.$action.'</td>';
  $table.='</tr>';
}

$table.='</table>';

echo $table;
//dd($data1);
 ?>

</div>

<script type="text/javascript">
  
$('.btn-act').click( function(){

  $.get( $( this ).attr('href'), function( data ) {
    $( "#module_edit" ).html( data );
    $("html, body").animate({ scrollTop: 0 }, "slow");
     $('#module_view').removeClass( "active" );
    $('[class="active"]').removeClass( "active" );
    $('[href="#module_edit"]').closest("li").addClass( "active" );
    $('#module_edit').addClass( "active" );
    $("html, body").cftoaster({content: 'Edit'});
   });

 }); 

$( ".btn-delete" ).click(  function() {
 
  $.get( $( this ).attr('href'), function( data ) {

            obj = JSON.parse(data);
             if(obj.status=='200'){
                    frm2= $("#moduleView_table");
                    $.get( frm2.attr('action'), function( data ) {
                       $( "#moduleView_table" ).html( data );
                     });
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("html, body").cftoaster({content: obj.msg});
                    
                    
                  }else{
                    var error='';
                    obj.msg.forEach(function(er) {
                      error+=er+"\n" ;
                    });
                $("html, body").animate({ scrollTop: 0 }, "slow");
                  $("html, body").cftoaster({content: error});
                  }

                       
                     });

});
</script>
 @push('js')

$('.btn-act').click( function(){

  $.get( $( this ).attr('href'), function( data ) {
    $( "#module_edit" ).html( data );
    $("html, body").animate({ scrollTop: 0 }, "slow");
     $('#module_view').removeClass( "active" );
    $('[class="active"]').removeClass( "active" );
    $('[href="#module_edit"]').closest("li").addClass( "active" );
    $('#module_edit').addClass( "active" );
    $("html, body").cftoaster({content: 'Edit'});
   });

 }); 

$( ".btn-delete" ).click(  function() {
 
  $.get( $( this ).attr('href'), function( data ) {

            obj = JSON.parse(data);
             if(obj.status=='200'){
                    frm2= $("#moduleView_table");
                    $.get( frm2.attr('action'), function( data ) {
                       $( "#moduleView_table" ).html( data );
                     });
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("html, body").cftoaster({content: obj.msg});
                    
                    
                  }else{
                    var error='';
                    obj.msg.forEach(function(er) {
                      error+=er+"\n" ;
                    });
                $("html, body").animate({ scrollTop: 0 }, "slow");
                  $("html, body").cftoaster({content: error});
                  }

                       
                     });

});

 @endpush
