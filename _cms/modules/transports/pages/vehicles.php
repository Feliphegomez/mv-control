<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Vehiculos</h1>
    </div>
  </header>
  <main id="app">
    <router-view></router-view>
  </main>
</div>

<template id="post-list">
  <div>
    <div class="actions">
      <router-link class="btn btn-primary" v-bind:to="{path: '/add-post'}">
        <span class="glyphicon glyphicon-plus"></span>
        Nuevo
      </router-link>
    </div>
    <div class="filters row">
      <div class="form-group col-sm-3">
        <label for="search-element">Filter</label>
        <input v-model="searchKey" class="form-control" id="search-element" required/>
      </div>
    </div>
    <table class="table table-responsive">
      <thead>
      <tr>
        <th>ID</th>
        <th>Placa</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo de vehiculo</th>
        <th>Capacidad de pasajeros</th>
        <th class="col-sm-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.license_plate }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.brand }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.model }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.category.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.passangers_capacity }}</router-link></td>
        <td>
          <router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'post-edit', params: {post_id: post.id}}">Modificar</router-link>
          <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'post-delete', params: {post_id: post.id}}">Eliminar</router-link>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<template id="add-post">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>INFORMACION DEL VEHICULO:</b>
                        </h4>
                    </div>
                    <form v-on:submit="createpost" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                      <div class="form-group">
                                        <label for="add-content">Placa</label>
                                        <input class="form-control" type="text"  v-model="post.license_plate" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Marca</label>
                                        <input class="form-control" type="text"  v-model="post.brand" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Modelo</label>
                                        <input class="form-control" type="text"  v-model="post.model" />
                                      </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Categoria de vehículo</label>
                                      <select class="form-control" v-model="post.category">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in categoryVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                                
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad Pasajeros</label>
                                        <input class="form-control" type="number"  v-model="post.passangers_capacity" />
                                      </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Combustible</label>
                                      <select class="form-control" v-model="post.fuel">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in fuelsVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-lg-2">
                                      <div class="form-group">
                                        <label for="add-content">Cilindraje</label>
                                        <input class="form-control" type="text"  v-model="post.cilindraje" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Titular</label>
                                        <input class="form-control" type="text"  v-model="post.holder" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Identificacion Propietario</label>
                                        <input class="form-control" type="text"  v-model="post.identification_number_propietary" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Nombre del Propietario</label>
                                        <input class="form-control" type="text"  v-model="post.name_propietary" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Numero Tarjeta Propiedad</label>
                                        <input class="form-control" type="text"  v-model="post.card_propiety_number" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Numero de chasis</label>
                                        <input class="form-control" type="text"  v-model="post.chassis_number" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Numero SOAT</label>
                                        <input class="form-control" type="text"  v-model="post.soat_number" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Numero Poliza Terceros</label>
                                        <input class="form-control" type="text"  v-model="post.third_party_number" />
                                      </div>
                                </div>                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Fecha Vencimiento SOAT</label>
                                        <input class="form-control" type="date"  v-model="post.soat_date_expiration" />
                                      </div>
                                </div>
                                
                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Fecha Vencimiento Poliza Terceros</label>
                                        <input class="form-control" type="date"  v-model="post.third_party_date_expiration" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad con Realce</label>
                                        <input class="form-control" type="text"  v-model="post.capacity_with_enhancement" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad sin Realce</label>
                                        <input class="form-control" type="text"  v-model="post.capacity_without_enhancement" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-6">
                                      <div class="form-group">
                                        <label for="add-content">Peso Base Vehiculo</label>
                                        <input class="form-control" type="text"  v-model="post.base_weight" />
                                      </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Estado</label>
                                      <select class="form-control" v-model="post.status">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in statusVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                              
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                      <button type="submit" class="btn btn-primary">Crear</button>
                                      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>TRIPULACION:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                              Debes crear primero el vehiculo antes de poder agregar la tripulacion.
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<template id="post">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>INFORMACION DEL VEHICULO:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                  <div class="form-group">
                                    <label for="add-content">Placa</label>
                                    <input class="form-control" type="text"  v-model="post.license_plate" />
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Marca</label>
                                    <input class="form-control" type="text"  v-model="post.brand" />
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Modelo</label>
                                    <input class="form-control" type="text"  v-model="post.model" />
                                  </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Categoria de vehículo</label>
                                  <select class="form-control" v-model="post.category">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in categoryVehiclesList">{{ item.name }}</option>
                                  </select>
                              </div>
                            </div>
                            
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Capacidad Pasajeros</label>
                                    <input class="form-control" type="number"  v-model="post.passangers_capacity" />
                                  </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Combustible</label>
                                  <select class="form-control" v-model="post.fuel">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in fuelsVehiclesList">{{ item.name }}</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-lg-2">
                                  <div class="form-group">
                                    <label for="add-content">Cilindraje</label>
                                    <input class="form-control" type="text"  v-model="post.cilindraje" />
                                  </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Titular</label>
                                    <input class="form-control" type="text"  v-model="post.holder" />
                                  </div>
                            </div>
                            
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Identificacion Propietario</label>
                                    <input class="form-control" type="text"  v-model="post.identification_number_propietary" />
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Nombre del Propietario</label>
                                    <input class="form-control" type="text"  v-model="post.name_propietary" />
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Numero Tarjeta Propiedad</label>
                                    <input class="form-control" type="text"  v-model="post.card_propiety_number" />
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                  <div class="form-group">
                                    <label for="add-content">Numero de chasis</label>
                                    <input class="form-control" type="text"  v-model="post.chassis_number" />
                                  </div>
                            </div>
                            
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Numero SOAT</label>
                                    <input class="form-control" type="text"  v-model="post.soat_number" />
                                  </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Numero Poliza Terceros</label>
                                    <input class="form-control" type="text"  v-model="post.third_party_number" />
                                  </div>
                            </div>                                
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Fecha Vencimiento SOAT</label>
                                    <input class="form-control" type="date"  v-model="post.soat_date_expiration" />
                                  </div>
                            </div>
                            
                            
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Fecha Vencimiento Poliza Terceros</label>
                                    <input class="form-control" type="date"  v-model="post.third_party_date_expiration" />
                                  </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Capacidad con Realce</label>
                                    <input class="form-control" type="text"  v-model="post.capacity_with_enhancement" />
                                  </div>
                            </div>
                            <div class="col-lg-4">
                                  <div class="form-group">
                                    <label for="add-content">Capacidad sin Realce</label>
                                    <input class="form-control" type="text"  v-model="post.capacity_without_enhancement" />
                                  </div>
                            </div>
                            
                            <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="add-content">Peso Base Vehiculo</label>
                                    <input class="form-control" type="text"  v-model="post.base_weight" />
                                  </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Estado</label>
                                  <select class="form-control" v-model="post.status">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in statusVehiclesList">{{ item.name }}</option>
                                  </select>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>TRIPULACION:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                  
                                    <tr v-for="driver in post.crew_vehicles">
                                        <td>{{ driver.charge.name }} </td>
                                        <td>                                        
                                          <select class="form-control" v-model="driver.employee" disabled="">
                                            <option value="0">Seleccione una opcion.</option>
                                            <option v-bind:value="item.id" v-for="item in employeeList">
                                              {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}
                                            </option>
                                          </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="card card-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <i class="glyphicon glyphicon-lock text-gold"></i>
                                        <b>GALERIA</b>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3" v-for="img in post.galery_vehicles">
                                            
                                            <a class="btn btn-info btn-xs" target="_new" v-bind:href="'/images/' + img.image"><i class="fa fa-eye"></i> Ver</a>
                                            <hr>
											<img width="100%" class="image image-responsive" v-bind:src="'/images/' + img.image" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-lg-12">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                <router-link class="btn btn-lg btn-primary" v-bind:to="'/'">Volver a la lista de mensajes</router-link>
            </div>
        </div>
    </div>
</template>

<template id="post-edit">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>INFORMACION DEL VEHICULO:</b>
                        </h4>
                    </div>
                    <form v-on:submit="updatepost" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                      <div class="form-group">
                                        <label for="add-content">Placa</label>
                                        <input class="form-control" type="text"  v-model="post.license_plate" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Marca</label>
                                        <input class="form-control" type="text"  v-model="post.brand" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Modelo</label>
                                        <input class="form-control" type="text"  v-model="post.model" />
                                      </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Categoria de vehículo</label>
                                      <select class="form-control" v-model="post.category">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in categoryVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                                
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad Pasajeros</label>
                                        <input class="form-control" type="number"  v-model="post.passangers_capacity" />
                                      </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Combustible</label>
                                      <select class="form-control" v-model="post.fuel">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in fuelsVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-lg-2">
                                      <div class="form-group">
                                        <label for="add-content">Cilindraje</label>
                                        <input class="form-control" type="text"  v-model="post.cilindraje" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Titular</label>
                                        <input class="form-control" type="text"  v-model="post.holder" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Identificacion Propietario</label>
                                        <input class="form-control" type="text"  v-model="post.identification_number_propietary" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Nombre del Propietario</label>
                                        <input class="form-control" type="text"  v-model="post.name_propietary" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Numero Tarjeta Propiedad</label>
                                        <input class="form-control" type="text"  v-model="post.card_propiety_number" />
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                      <div class="form-group">
                                        <label for="add-content">Numero de chasis</label>
                                        <input class="form-control" type="text"  v-model="post.chassis_number" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Numero SOAT</label>
                                        <input class="form-control" type="text"  v-model="post.soat_number" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Numero Poliza Terceros</label>
                                        <input class="form-control" type="text"  v-model="post.third_party_number" />
                                      </div>
                                </div>                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Fecha Vencimiento SOAT</label>
                                        <input class="form-control" type="date"  v-model="post.soat_date_expiration" />
                                      </div>
                                </div>
                                
                                
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Fecha Vencimiento Poliza Terceros</label>
                                        <input class="form-control" type="date"  v-model="post.third_party_date_expiration" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad con Realce</label>
                                        <input class="form-control" type="text"  v-model="post.capacity_with_enhancement" />
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                      <div class="form-group">
                                        <label for="add-content">Capacidad sin Realce</label>
                                        <input class="form-control" type="text"  v-model="post.capacity_without_enhancement" />
                                      </div>
                                </div>
                                
                                <div class="col-lg-6">
                                      <div class="form-group">
                                        <label for="add-content">Peso Base Vehiculo</label>
                                        <input class="form-control" type="text"  v-model="post.base_weight" />
                                      </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Estado</label>
                                      <select class="form-control" v-model="post.status">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in statusVehiclesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                              
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                      <button type="submit" class="btn btn-primary">Guardar</button>
                                      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>TRIPULACION:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <router-link class="btn btn-success btn-xs" v-bind:to="{name: 'driver-add', params: {post_id: post.id}}">
                                    <i class="fa fa-plus-square"></i> Crear 
                                </router-link>
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                  
                                    <tr v-for="driver in post.crew_vehicles">
                                        <td>{{ driver.charge.name }} </td>
                                        <td>                                        
                                          <select class="form-control" v-model="driver.employee" disabled="">
                                            <option value="0">Seleccione una opcion.</option>
                                            <option v-bind:value="item.id" v-for="item in employeeList">
                                              {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}
                                            </option>
                                          </select>
                                        </td>
                                        <td>
                                           <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'driver-delete', params: {post_id: post.id, driver_id: driver.id }}">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </router-link>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <i class="glyphicon glyphicon-lock text-gold"></i>
                                        <b>Agregar Imagen</b>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group image-preview">
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title">Browse</span>
                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" @change="changeImage" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <input v-model="image_preview.name" type="text" class="form-control" />
                                        </div>
                                        <div class="col-lg-3">
                                            <input v-model="image_preview.type" type="hidden" class="form-control" readonly="" />
                                        </div>
                                        <div class="col-lg-3">
                                            <input v-model="image_preview.size" type="hidden" class="form-control" readonly="" />
                                        </div>
                                        <div class="col-lg-12">
                                            <input v-model="image_preview.src" type="hidden" class="form-control image-preview-filename" readonly="" />
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-group image-preview">
                                                <img id="dynamic" width="100%" v-bind:src="image_preview.src" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <i class="glyphicon glyphicon-lock text-gold"></i>
                                        <b>GALERIA</b>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4" v-for="img in post.galery_vehicles">
                                            <img width="100%" class="image image-responsive" v-bind:src="'/images/' + img.image" />
                                            <hr>
                                            <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'galery_vehicles-delete', params: {galery_vehicles_id: img.id }}">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </router-link>
                                            <a class="btn btn-info btn-xs" target="_new" v-bind:href="'/images/' + img.image"><i class="fa fa-eye"></i> Ver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<template id="post-delete">
  <div>
    <h2>Delete post {{ post.id }}</h2>
    <form v-on:submit="deletepost" method="POST">
      <p>The action cannot be undone.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="add-driver">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>AGREGAR:</b>
                        </h4>
                    </div>
                    <form v-on:submit="createpost" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Vehículo</label>
                                      <select class="form-control" v-model="post.vehicle" disabled="">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in vehiclesList">{{ item.license_plate }} {{ item.brand }} {{ item.model }}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Empleado</label>
                                      <select class="form-control" v-model="post.employee">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in employeeList">
                                            {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}
                                        </option>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Cargo</label>
                                      <select class="form-control" v-model="post.charge">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in employeeChargesList">
                                            {{ item.name }}
                                        </option>
                                      </select>
                                  </div>
                                </div>
                            </div>
                        </div>
                              
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                      <button type="submit" class="btn btn-primary">Crear</button>
                                      <router-link class="btn btn-primary" v-bind:to="'/post/' + post_id + '/edit'">Cancelar</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<template id="driver-delete">
  <div>
    <h2>Eliminar {{ driver_id }}</h2>
    <form v-on:submit="deletepost" method="POST">
      <p>Se va a eliminar el conductor de manera permanente.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <router-link class="btn btn-primary" v-bind:to="'/post/' + post_id + '/edit'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="galery_vehicles-delete">
  <div>
    <h2>Delete galery_vehicles {{ galery_vehicles_id }}</h2>
    <form v-on:submit="deletegalery_vehicles" method="POST">
      <p>The action cannot be undone.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
  </div>
</template>
