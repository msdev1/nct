 <div class="navbar navbar-default " role="navigation">
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>

             <a target="_self" href="{{ action('\Frontend\Modules\DY\MainController@index') }}" class="" ><img class="" style="max-height:50px;padding:1px;" src="{{asset($data['web']['LogoPath'])}}" alt="Test Image" /></a>
         </div>
         <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="" data-toggle="dropdown">
                  	 <i class="fa fa-home"></i> Home                   
                     </a>
                  </li>
              <li class="dropdown">
                     
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-industry"></i> Company
                     <i class="caret"></i></a>
                     <ul class="dropdown-menu">
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Overview</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Objectives</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Milestones</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Board of Directors</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Structure of Board</a>
                     </li>
                     </ul>
                  </li>
                  <li class="dropdown">
                     
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-users"></span> Member Zone
                     <i class="caret"></i></a>
                     <ul class="dropdown-menu">
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> eForms</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Download Forms</a>
                     </li>
                    <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> News</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Annpuncements</a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Events </a>
                     </li>
                     </ul>
                  </li>
                  <li class="">
                     
                     <a href="#" class="" data-toggle="dropdown"><span class="fa fa-life-ring"></span> Facility
                     </a>
                    
                  </li>
                   <li class="">
                     
                     <a href="#" class="" data-toggle="dropdown"><span class="fa fa-picture-o"></span> Gallery
                     </a>
                    
                  </li>
                  <li class="dropdown">
                     
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-beer"></i> Carrers
                     <i class="caret"></i></a>
                     <ul class="dropdown-menu">
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Head Human Resources </a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Head Project Execution </a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Head Public Relations </a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Head Technical Services </a>
                     </li>
                     <li>
                     <a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Technical Services Engineer </a>
                     </li>
                     </ul>
                  </li>

                  <li class="">
                     
                     <a href="#" class="" data-toggle="dropdown"><span class="fa fa-envelope"></span> Contact Us
                     </a>
                    
                  </li>

              </ul>
             <ul class="nav navbar-nav navbar-right">

<?php
                $user= new \BModel\User ();
      
      ?>


@if ($user->checkLogin())
     @include('layouts.Backend.Dynamic.user', ['user' => $user->getUser()])

@else
    <li class="dropdown">
                     <a href="#" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                         <span class="glyphicon glyphicon-user"></span> 
                         <strong>Login</strong>
                         <span class="caret"></span>
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                         <li>
                             <div class="navbar-login">
                                 <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       <div class=" panel-default">
                                          <div class="panel-body">
                                          <?php 
                                          $form=new \BModel\User ();
                                          $form->loginForm(); ?>
                                          </div>

                                        </div>


                                     </div>
                                 </div>
                             </div>
                         </li>
                        
                     </ul>
                 </li>
@endif

                 
             </ul>
         </div>
     </div>
 </div>