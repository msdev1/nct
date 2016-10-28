<?php
              $table=new \BModel\Module();
              $mm=\MS\Func::buildModuleMenu($table);
              $user=new \BModel\User ();
              $user=$user-> getUser();
?>

<div class="navbar navbar-default " role="navigation">
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a target="_blank" href="/backend" class="" ><img class="" style="max-height:40px;" src="{{asset('images/client/msdyna_logo_small_squar.png')}}" alt="Test Image" /></a>
         </div>
         <div class="collapse navbar-collapse">
            
          
              <?php
              echo \MS\Func::printModuleMenu($mm);

              ?>

             
                         
               <ul class="nav navbar-nav navbar-right">
      
               @include('layouts.Backend.Dynamic.user', ['user' => $user])
             </ul>
         </div>
     </div>
 </div>

<?php 

echo \MS\Func::breadcrumb($data['path']);

?>

