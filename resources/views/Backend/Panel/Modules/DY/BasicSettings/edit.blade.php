<?php 
$form =new \BModel\Modules\DY\BasicSettings();
$form->updateForm();

?>


@push('js')

 $(function() {

    var frm = $('#msDyna_Form_updateBasic');

        frm.submit(function (ev) {
          
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                  obj = data;
                  
                  if(obj.status=='200'){
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    frm.cftoaster({content: obj.msg});
                    frm2= $("#dy_basic_batch");
                    var1=$("#dy_basic__batch").attr('action');                                      
                    $.get( frm2.attr('action'), function( data ) {
                       $( "#dy_basic_batch" ).html( data );
                       frm.cftoaster({content: "table refreshed."});
                     });


                  }else{
                    var error='';
                    obj.msg.forEach(function(er) {
                      error+=er+"\n" ;
                    });
                $("html, body").animate({ scrollTop: 0 }, "slow");
                  frm.cftoaster({content: error});
                  }



                }
            });

           ev.preventDefault(); 
        });

  });
  

@endpush