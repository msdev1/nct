<?php $data1=$data['users']->all();
//dd($data1);
 ?>
<div id="moduleView_table" action="/backend/panel/config/module/api/view">
<?php



$table='<table class="table table-striped table-bordered">';
$table.='<tr  >
<th>id</th>
<th>Name</th>
<th>Username</th>
<th>Email</th>
<th>Contact No.</th>
<th>Last Login From</th>
<th class="text-center">Current Login Status</th>
<th class="text-center">Status</th>
<th class="text-center">Action</th>
</tr>';
foreach ($data1 as $value) {
  $status='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-danger disabled"><i class="fa fa-times" aria-hidden="true"></i></button></div>';
  if($value->Status==true){
    $status='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-success disabled"><i class="fa fa-check-square-o  " aria-hidden="true"></i></button></div>';
  }

  $currentstatus='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-danger disabled"><i class="fa fa-times " aria-hidden="true"></i></i></button></div>';
  if($value->CurrentLogin_status==true){
    $currentstatus='<div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button class="btn btn-secondary btn-success disabled"><i class="fa fa-check-square-o " aria-hidden="true"></i></button></div>';
  }

  $action=
  '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
  <button type="button" href="'.action("\\Backend\\Configure\\Modules\\UserMainController@user_Update",[$value->id]).'" class="btn btn-secondary btn-success "><i class="fa fa-eye  " aria-hidden="true"></i></button>
  <button type="button" class="btn btn-secondary btn-warning btn-user-edit" href="'.action("\\Backend\\Configure\\Modules\\UserMainController@user_Update",[$value->id]).'"><i class="fa fa-pencil" aria-hidden="true"></i></button>
  <button type="button" class="btn btn-secondary btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
  </div>';

  $table.='<tr>';
  $table.='<td>'.$value->id.'</td>';
  $table.='<td>'.$value->FirstName.' '.$value->LastName.'</td>';
  $table.='<td>'.$value->UserName.'</td>';
  $table.='<td>'.$value->eMail.'</td>';
  $table.='<td>'.$value->ContactNo.'</td>';
  $table.='<td>'.$value->CurrentLogin_ip.'</td>';
  $table.='<td class="text-center">'.$currentstatus.'</td>';
  $table.='<td class="text-center" >'.$status.'</td>';
  $table.='<td class="text-center">'.$action.'</td>';




  $table.='</tr>';
}

$table.='</table>';

echo $table;
//dd($data1);
 ?>

</div>
<script type="text/javascript">
  
$('.btn-user-edit').click( function(){

  $.get( $( this ).attr('href'), function( data ) {
    $( "#user_edit" ).html( data );
    $("html, body").animate({ scrollTop: 0 }, "slow");
     $('#user_view').removeClass( "active" );
    $('[class="active"]').removeClass( "active" );
    $('[href="#user_edit"]').closest("li").addClass( "active" );
    $('#user_edit').addClass( "active" );
    $("html, body").cftoaster({content: 'Edit'});
   });

 }); 

$( ".btn-user-delete" ).click(  function() {
 
  $.get( $( this ).attr('href'), function( data ) {

            obj = JSON.parse(data);
             if(obj.status=='200'){
                    frm2= $("#userView_table");
                    $.get( frm2.attr('action'), function( data ) {
                       $( "#userView_table" ).html( data );
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

$('.btn-user-edit').click( function(){

  $.get( $( this ).attr('href'), function( data ) {
    $( "#user_edit" ).html( data );
    $("html, body").animate({ scrollTop: 0 }, "slow");
     $('#user_view').removeClass( "active" );
    $('[class="active"]').removeClass( "active" );
    $('[href="#user_edit"]').closest("li").addClass( "active" );
    $('#user_edit').addClass( "active" );
    $("html, body").cftoaster({content: 'Edit'});
   });

 }); 

$( ".btn-user-delete" ).click(  function() {
 
  $.get( $( this ).attr('href'), function( data ) {

            obj = JSON.parse(data);
             if(obj.status=='200'){
                    frm2= $("#userView_table");
                    $.get( frm2.attr('action'), function( data ) {
                       $( "#userView_table" ).html( data );
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

