


<?php $data['form']->moduleAddForm(); ?>

<script type="text/javascript">
  
  $(function() {

    var frm = $('#msDyna_Form_addModule');

        frm.submit(function (ev) {
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                  console.log(data);
                  obj = JSON.parse(data);

                  if(obj.status=='200'){
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    frm.cftoaster({content: obj.msg});
                    frm2= $("#module_view");
                    var1=$("#module_add").attr('action');
                  $.get( var1, function( data ) {

                       $( "#module_add" ).html( data );
                       
                     });                    

                    $.get( frm2.attr('action'), function( data ) {
                       $( "#module_view" ).html( data );
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
  
</script>

@push('js')



	$(function() {

    var frm = $('#msDyna_Form_addModule');

        frm.submit(function (ev) {
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                  obj = JSON.parse(data);
                  if(obj.status=='200'){
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    frm.cftoaster({content: obj.msg});
                    frm2= $("#module_view");
                    var1=$("#module_add").attr('action');
                  $.get( var1, function( data ) {

                       $( "#module_add" ).html( data );
                       
                     });                    

                    $.get( frm2.attr('action'), function( data ) {
                       $( "#module_view" ).html( data );
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
