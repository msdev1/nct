@extends('layouts.plate')
@section('Title', 'Backend :Control Panel')


@section('content')
<?php
//dd($user);

$user=$data['user'];
//dd($data['test']->nav($user));
//dd($nav);

//dd($data);

//dd($data['request']->url());


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

              $table=new \BModel\Module();
              $mm=\MS\Func::buildModuleMenu($table);

              echo \MS\Func::printModuleMenu($mm);
              ?>

             
                         
              
             <ul class="nav navbar-nav navbar-right">

             @include('layouts.Backend.Dynamic.user', ['user' => $user])

             </ul>
         </div>
     </div>
 </div>
 <div class="mainPanel">
     
 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
dklflkdlf
</div>
@endsection
