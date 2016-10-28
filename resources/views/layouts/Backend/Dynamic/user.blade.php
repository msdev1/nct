<li class="dropdown">
                     <a href="#" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                         <span class="glyphicon glyphicon-user"></span> 
                         <strong>{{$user['UserName']}}</strong>
                         <i class="caret"></i>
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                         <li>
                             <div class="navbar-login">
                                 <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                                         <p class="text-center">
                                             <span class="fa fa-user icon-size"></span><p class="text-center"><strong>{{$user['FirstName']}} {{$user['LastName']}}</strong></p>
                                         </p>
                                     </div>
                                     <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                       <div class="panel panel-default">
                                          <div class="panel-body">
                                            <p class="text-center small text-muted">Your Registred Email: {{$user['eMail']}}</p>
                                          </div>

                                        </div>


                                         <p class="text-center">
                                           <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                            <a class="btn-group" role="group" href="{{action('\\Backend\\PanelController@configMenu',['mainTab'=>'user','subTab'=>'edit','id'=>$user['id']])}}"> <button type="button" class="btn btn-default btn-success" href="/"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</button></a>


                                           </div>
                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="divider"></li>
                         <li>
                             <div class="navbar-login navbar-login-session">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <p>
                                           <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                            <a class="btn-group" role="group" href="{{action('\\Backend\\PanelController@configMenu')}}"> <button type="button" class="btn btn-warning"><i class="fa fa-cogs" aria-hidden="true"></i> Configure</button></a>
                                            <a class="btn-group" role="group" href="{{url('backend/panel/logout ')}}"> <button type="button" class="btn btn-danger " href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button></a>
                                           </div>

                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     </ul>
                 </li>