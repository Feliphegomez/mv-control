<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Crear Actividad</h1>
    </div>
  </header>
  <main id="app">
    <router-view></router-view>
  </main>
</div>

<template id="post-list">
    <div>
        <div class="col-lg-12">
            <div id="_accordion">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="glyphicon glyphicon-search text-gold"></i>
                                    <b>PASO 1: INFORMACION DEL CLIENTE</b>
                                </h4>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tipo de identificacion</label>
                                                <select class="form-control" v-model="identification_type">
                                                    <option value="" selected="selected">Seleccione una opcion.</option>
                                                    <option v-bind:value="item.id" v-for="item in identificationTypesList">{{ item.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Tipo de Identificacion</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" aria-label="" v-model="identification_number" />
                                                  <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" @click="searchClient"><i class="fa fa-search"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-down"></i></button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" href="#"><i class="fa fa-search"></i> Buscar</a>
                                                      <div role="separator" class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-plus"></i> Nuevo</a>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Tipo de cliente</label>
                                                <input type="text" class="form-control" v-model="client.client_type.name" />
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-md-1 col-lg-1">
                                            <div class="form-group">
                                                <label class="control-label">Activo</label>
                                                <input class="form-control" type="checkbox" />
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">client_type</label>
                                                <div class="input-group date">
                                                    <input class="form-control" type="text" />
                                                   <span class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button></span>
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Razon social</label>
                                                <input type="text" class="form-control" v-model="client.social_reason" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Nombre comercial</label>
                                                <input type="text" class="form-control" v-model="client.tradename" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Tipo de sociedad</label>
                                                <input type="text" class="form-control" v-model="client.society_type.name" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label">Telefono Fijo</label>
                                                <input type="text" class="form-control" v-model="client.phone" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Telefono Movil</label>
                                                <input type="text" class="form-control" v-model="client.phone_mobile" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Correo Electronico</label>
                                                <input type="text" class="form-control" v-model="client.mail" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a href="#collapse2">
                                        <i class="glyphicon glyphicon-lock text-gold"></i>
                                        <b>PASO 2: Agregar Servicios</b>
                                    </a>
                                </h4>
                            </div>
                            <div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-lg-12">
                                            <div class=" target">
                                                <div class="row clearfix">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                                            <thead>
                                                                <tr >
                                                                    <th class="text-center">
                                                                        Servicio
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Cantidad
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Concurrencia
                                                                    </th>
                                                                    <th class="text-center">
                                                                        notas
                                                                    </th>
                                                                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr id='addr0' data-id="0" class="hidden">
                                                                    <td data-name="sel">
                                                                        <select name="sel0" class="form-control">
                                                                            <option value="" selected="selected">Seleccione una opcion.</option>
                                                                            <option v-bind:value="item.id" v-for="item in servicesList">{{ item.name }}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td data-name="name">
                                                                        <input type="text" name='name0'  placeholder='Name' class="form-control"/>
                                                                    </td>
                                                                    <td data-name="mail">
                                                                        <input type="text" name='mail0' placeholder='Email' class="form-control"/>
                                                                    </td>
                                                                    <td data-name="desc">
                                                                        <textarea name="desc0" placeholder="Description" class="form-control"></textarea>
                                                                    </td>
                                                                    <td data-name="del">
                                                                        <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <a id="add_row" class="btn btn-default pull-right">Add Row</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a href="#collapse2">
                                        <i class="glyphicon glyphicon-lock text-gold"></i>
                                        <b>PASO 3: INFORMACION DEL SERVICIO A BRINDAR</b>
                                    </a>
                                </h4>
                            </div>
                            <div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">first</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">Middle</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Department</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">School/Organization</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label">School/Organization Address</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">State</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-2">
                                            <div class="form-group">
                                                <label class="control-label">Zip Code</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-lg-5">
                                            <div class="form-group">
                                                <label class="control-label">Contact Information:(Phone Number)</label>
                                                <input type="text" class="phone form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Fax Number</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <label class="control-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="control-label">Please mark the appropriate box that best describes this candidate:</label>

                                            <table class="table table-primary">
                                                <thead>
                                                    <tr>
                                                        <th>

                                                        </th>
                                                        <th>
                                                            EXCELLENT
                                                        </th>
                                                        <th>
                                                            GOOD
                                                        </th>

                                                        <th>
                                                            AVERAGE
                                                        </th>

                                                        <th>
                                                            BELOW AVERAGE
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Academic Background
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Artistic Skill
                                                        </td>
                                                        <td>
                                                            <input type="checkbox">
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Character
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Ambition
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Emotional Stability
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Ability To work with Others
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Communication Skills
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="control-label">
                                                                <input type="checkbox">
                                                            </label>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <label class="control-label">Comments (please feel free toattach a letter or other documentation):</label>
                                            <textarea rows="6" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="control-label">I recommend this candidate:</label>

                                            <label class="control-label">
                                                <input type="checkbox" >
                                                With Reservation
                                            </label>
                                            <label class="control-label">
                                                <input type="checkbox" >
                                                Failry Strongly
                                            </label>

                                            <label class="control-label">
                                                <input type="checkbox">
                                                Strongly
                                            </label>
                                            <label class="control-label">
                                                <input type="checkbox">
                                                Enthusiastically
                                            </label>

                                        </div>

                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a href="#" class="btn btn-success btn-lg" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
                                <a class="btn btn-warning btn-lg" href="#" id="btnToTop"><i class="fa fa-arrow-up"></i> Top</a>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
        </div>



  </div>
</template>

