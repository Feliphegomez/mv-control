<?php
    if(isset($_GET['profile_id'])){
        $_GET['profile_id'] = (int) $_GET['profile_id'];
        $profileView = new Profile($_GET['profile_id']);
        # echo json_encode($profileView);
        if($profileView->id <= 0) exit('perfil invalido');
    }else{
        exit('Perfil no encontrado');
    }
?>
<div class=" target">
    <div class="row">
        <div class="col-sm-10">
             <h1 class=""><?php echo $profileView->first_name; ?> <?php echo $profileView->second_name; ?> <?php echo $profileView->surname; ?> <?php echo $profileView->second_surname; ?></h1>
         
          <button type="button" class="btn btn-warning">Edit Profile</button>  <button type="button" class="btn btn-success">Access Calendar</button>
<br>
        </div>
      <div class="col-sm-2"><a href="/users" class="pull-sright"><img title="profile image" class="img-circle img-responsive" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBG685vI07-3MsuqJxjCfzIabfFJJG-8yM-ppvjjNpD5QNtWNE4A"></a>

        </div>
    </div>
  <br>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Informacion Básica</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">first_name: </strong></span> <?php echo $profileView->first_name; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">second_name: </strong></span> <?php echo $profileView->second_name; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">surname: </strong></span> <?php echo $profileView->surname; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">second_surname: </strong></span> <?php echo $profileView->second_surname; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">identification_type: </strong></span> <?php echo $profileView->identification_type; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">identification_number: </strong></span> <?php echo $profileView->identification_number; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">identification_date_expedition: </strong></span> <?php echo $profileView->identification_date_expedition; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">birthdate: </strong></span> <?php echo $profileView->birthdate; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">blood_type: </strong></span> <?php echo $profileView->blood_type; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">blood_rh: </strong></span> <?php echo $profileView->blood_rh; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">mail: </strong></span> <?php echo $profileView->mail; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">number_phone: </strong></span> <?php echo $profileView->number_phone; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">number_mobile: </strong></span> <?php echo $profileView->number_mobile; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">avatar: </strong></span> <?php echo $profileView->avatar; ?></li>
                
            </ul>
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Mas Informacion</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">eps: </strong></span> <?php echo $profileView->eps; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">arl: </strong></span> <?php echo $profileView->arl; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">pension_fund: </strong></span> <?php echo $profileView->pension_fund; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">compensation_fund: </strong></span> <?php echo $profileView->compensation_fund; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">severance_fund: </strong></span> <?php echo $profileView->severance_fund; ?>.</li>
            </ul>
            
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Informacion Corporativa</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">status: </strong></span> <?php echo $profileView->status; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">company_date_entry: </strong></span> <?php echo $profileView->company_date_entry; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">company_mail: </strong></span> <?php echo $profileView->company_mail; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">company_number_phone: </strong></span> <?php echo $profileView->company_number_phone; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">company_number_mobile: </strong></span> <?php echo $profileView->company_number_mobile; ?>.</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">gang: </strong></span> <?php echo $profileView->gang; ?>.</li>
                
            </ul>
           <div class="panel panel-default">
             
             <div class="panel-heading">Reminders:

                </div>
                <div class="panel-body"><button type="button" class="btn btn-info">Patient Compliance<br><button type="button" class="btn btn-secondary">Approve Uploads
                

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">NOTIFICATIONS <i class="fa fa-link fa-1x"></i>

                </div>
                <div class="panel-body"><a href="http://bootply.com" class="">~Non-compliance to certain checklist items~</a>

                </div>
            </div>
        </div>
        <!--/col-3-->
        <div class="col-sm-9" style="" contenteditable="false">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Shared Treatment Section</b></div>
                <div class="panel-body"><i>Select the plan corresponding to your need. You will be redirected to the access page where you can edit the selected pre-made scheme.</i><br>
                <button type="button" class="btn btn-primary">Treatment Plan A</button>   <button type="button" class="btn btn-primary">Treatment Plan B</button>   <button type="button" class="btn btn-primary">Treatment Plan C</button>   <button type="button" class="btn btn-primary">Treatment Plan D</button>   <button type="button" class="btn btn-Primary">Create Plan</button>

                </div>
            </div>
            
            <!--
            <div class="panel panel-default target">
                <div class="panel-heading" contenteditable="false"><b>Treatments and Medications Needed</b></div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img alt="300x200" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/UPMCEast_CTscan.jpg/280px-UPMCEast_CTscan.jpg">
                                <div class="caption">
                                    <h3>
                                        Computed Tomography Scan
                                    </h3>
                                    <p>
                                        For potential transcatheter repair and replacement of heart valves 
                                    </p>
                                    <p>
                                    
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img alt="300x200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEQz__ycuhuAoNISn3rNWuaZhhzH4lAnPg0IvmQXJpkN08pC5oZA">
                                <div class="caption">
                                    <h3>
                                        Counselling Service
                                    </h3>
                                    <p>
                                        For stability of emotional threshold throughout the battery of tests
                                    </p>
                                    <p>
                                    
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img alt="300x200" src="https://assets.nhs.uk/prod/images/C0097883.2e16d0ba.fill-920x613.jpg">
                                <div class="caption">
                                    <h3>
                                        Cardiac Catheterization
                                    </h3>
                                    <p>
                                        For further evaluation of other implicitly acquired cardiovascular conditions
                                    </p>
                                    <p>
                                    
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
    
            <div class="panel panel-default">
                <div class="panel-heading"><b>Daily Medication and Treatment Breakdown:</b></div>
                <div class="panel-body"> Textual, descriptive form of the above checklist
                    <br><button type="button" class="btn btn-primary">Generate Report

                </div>
            </div>
        </div>
    </div>
</div>