<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Empleados</h1>
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
        <th>Numero de identificacion</th>
        <th>Nombre Completo</th>
        <th>Fijo</th>
        <th>Móvil</th>
        <th>Fijo/Extension Empresa</th>
        <th>Móvil Empresa</th>
        <th>Estado</th>
        <th>EPS</th>
        <th>ARL</th>
        <th class="col-sm-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.identification_number }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.first_name }} {{ post.second_name }} {{ post.surname }} {{ post.second_surname }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.number_phone }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.number_mobile }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.company_number_phone }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.company_number_mobile }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.status.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.eps.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.arl.name }}</router-link></td>
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
    <h2>Nuevo</h2>
    <form v-on:submit="createpost">
      
        <div class="row">
            <div class="col-md-2 row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="control-label">Avatar</label>
                      <input class="form-control" type="text" v-model="post.avatar" />
                  </div>
              </div>
            </div>
            <div class="col-md-10 row">
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Primer Nombre</label>
                      <input class="form-control" type="text" v-model="post.first_name" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Segundo Nombre</label>
                      <input class="form-control" type="text" v-model="post.second_name" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Primer Apellido</label>
                      <input class="form-control" type="text" v-model="post.surname" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Segundo Apellido</label>
                      <input class="form-control" type="text" v-model="post.second_surname" />
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Tipo de identificacion</label>
                      <select class="form-control" v-model="post.identification_type">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in identificationTypesList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label"># de identificacion</label>
                      <input class="form-control" type="text" v-model="post.identification_number" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Fecha de expedicion</label>
                      <input class="form-control" type="date" v-model="post.identification_date_expedition" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Fecha de Nacimiento</label>
                      <input class="form-control" type="date" v-model="post.birthdate" />
                  </div>
              </div>

              <div class="col-md-2">
                  <div class="form-group">
                      <label class="control-label">T. Sangre</label>
                      <select class="form-control" v-model="post.blood_type">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in bloodTypesList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label class="control-label">Tipo de RH</label>
                      <select class="form-control" v-model="post.blood_rh">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in bloodRHsList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">Correo Electronico</label>
                      <input class="form-control" type="text" v-model="post.mail" />
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label class="control-label">Telefono Fijo</label>
                      <input class="form-control" type="text" v-model="post.number_phone" />
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label class="control-label">Telefono Movil</label>
                      <input class="form-control" type="text" v-model="post.number_mobile" />
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">F. de ingreso</label>
                      <input class="form-control" type="date" v-model="post.company_date_entry" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">F. de retiro</label>
                      <input class="form-control" type="date" v-model="post.company_date_out" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Correo Empresarial</label>
                      <input class="form-control" type="text" v-model="post.company_mail" />
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Fijo/Extension</label>
                      <input class="form-control" type="text" v-model="post.company_number_phone" />
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Móvil Empresarial</label>
                      <input class="form-control" type="text" v-model="post.company_number_mobile" />
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label class="control-label">Estado</label>
                      <select class="form-control" v-model="post.status">
                          <option value="0">Seleccione una opcion.</option>
                          <option v-bind:value="item.id" v-for="item in statusEmployeeList">{{ item.name }}</option>
                        </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">EPS</label>
                      <select class="form-control" v-model="post.eps">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in epsList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">ARL</label>
                      <select class="form-control" v-model="post.arl">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in arlList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">Fondo Pensiones</label>
                      <select class="form-control" v-model="post.pension_fund">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in pensionFundsList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">Caja de compensacion</label>
                      <select class="form-control" v-model="post.compensation_fund">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in compensationFundsList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="control-label">Fondo de Cesantias</label>
                      <select class="form-control" v-model="post.severance_fund">
                        <option value="0">Seleccione una opcion.</option>
                        <option v-bind:value="item.id" v-for="item in severanceFundsList">{{ item.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="control-label">Observaciones</label>
                      <textarea class="form-control" v-model="post.observations"></textarea>
                  </div>
              </div>
            </div>
        </div>
      <button type="submit" class="btn btn-primary">Crear</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
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
                            <b>Informacion Empleado:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-2 row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Avatar</label>
                                    <input class="form-control" type="text" v-model="post.avatar" readonly="" disabled="" />
                                </div>
                            </div>
                          </div>
                          <div class="col-md-10 row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Primer Nombre</label>
                                    <input class="form-control" type="text" v-model="post.first_name" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Segundo Nombre</label>
                                    <input class="form-control" type="text" v-model="post.second_name" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Primer Apellido</label>
                                    <input class="form-control" type="text" v-model="post.surname" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Segundo Apellido</label>
                                    <input class="form-control" type="text" v-model="post.second_surname" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tipo de identificacion</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.identification_type.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label"># de identificacion</label>
                                    <input class="form-control" type="text" v-model="post.identification_number" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Fecha de expedicion</label>
                                    <input class="form-control" type="date" v-model="post.identification_date_expedition" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Fecha de Nacimiento</label>
                                    <input class="form-control" type="date" v-model="post.birthdate" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">T. Sangre</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.blood_type.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Tipo de RH</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.blood_rh.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Correo Electronico</label>
                                    <input class="form-control" type="text" v-model="post.mail" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Telefono Fijo</label>
                                    <input class="form-control" type="text" v-model="post.number_phone" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Telefono Movil</label>
                                    <input class="form-control" type="text" v-model="post.number_mobile" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">F. de ingreso</label>
                                    <input class="form-control" type="date" v-model="post.company_date_entry" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">F. de retiro</label>
                                    <input class="form-control" type="date" v-model="post.company_date_out" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Correo Empresarial</label>
                                    <input class="form-control" type="text" v-model="post.company_mail" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Fijo/Extension</label>
                                    <input class="form-control" type="text" v-model="post.company_number_phone" readonly="" disabled="" />
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Móvil Empresarial</label>
                                    <input class="form-control" type="text" v-model="post.company_number_mobile" readonly="" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Estado</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.status.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">EPS</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.eps.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">ARL</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.arl.name }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Fondo Pensiones</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.pension_fund.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Caja de compensacion</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.compensation_fund.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Fondo de Cesantias</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option>{{ post.severance_fund.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Observaciones</label>
                                    <textarea class="form-control" v-model="post.observations" readonly="" disabled=""></textarea>
                                </div>
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
                            <b>Contactos:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                          <table class="table table-responsive">
                            <tr>
                              <th>Nombre Completo</th>
                              <th>Identificacion</th>
                              <th>Correo Electronico</th>
                              <th>Numero de Telefono</th>
                              <th>Numero de Movil</th>
                              <th>Parentesco</th>
                              <th>Observaciones</th>
                            </tr>
                            <tr v-for="contact in post.contacts_employee">
                              <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.surname }} {{ contact.second_surname }}</td>
                              <td>{{ contact.identification_number }}</td>
                              <td>{{ contact.mail }}</td>
                              <td>{{ contact.number_phone }}</td>
                              <td>{{ contact.number_mobile }}</td>
                              <td>{{ contact.relationship }}</td>
                              <td>{{ contact.description }}</td>
                            </tr>
                          </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    <br/>
    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
    <router-link class="btn btn-lg btn-primary" v-bind:to="'/'">Volver a la lista de mensajes</router-link>
    </div>
</template>

<template id="post-edit">
  <div>
    <form v-on:submit="updatepost">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>Informacion Basica:</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 row">
                              <div class="col-md-12">
                                  <div class="form-group" style="min-height: 350px;height:350px;">
                                      <label class="control-label">Avatar</label>
                                      <img width="100%" class="image image-responsive" v-bind:src="'/images/' + post.avatar" />
                                  </div>
                                                
                                                
                                    <div class="input-group image-preview" style="float-right">
                                        <div class="btn btn-default image-preview-input">
                                            <span class="glyphicon glyphicon-folder-open"></span>
                                            <span class="image-preview-input-title"> <i class="fa fa-plus"></i> <i class="fa fa-camera"></i> </span>
                                            <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" @change="changeImage" />
                                        </div>
                                    </div>
                              </div>
                            </div>
                            <div class="col-md-10 row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Primer Nombre</label>
                                      <input class="form-control" type="text" v-model="post.first_name" />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Segundo Nombre</label>
                                      <input class="form-control" type="text" v-model="post.second_name" />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Primer Apellido</label>
                                      <input class="form-control" type="text" v-model="post.surname" />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Segundo Apellido</label>
                                      <input class="form-control" type="text" v-model="post.second_surname" />
                                  </div>
                              </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Tipo de identificacion</label>
                                      <select class="form-control" v-model="post.identification_type.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in identificationTypesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label"># de identificacion</label>
                                      <input class="form-control" type="text" v-model="post.identification_number" />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Fecha de expedicion</label>
                                      <input class="form-control" type="date" v-model="post.identification_date_expedition" />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Fecha de Nacimiento</label>
                                      <input class="form-control" type="date" v-model="post.birthdate" />
                                  </div>
                              </div>

                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="control-label">T. Sangre</label>
                                      <select class="form-control" v-model="post.blood_type.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in bloodTypesList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="control-label">Tipo de RH</label>
                                      <select class="form-control" v-model="post.blood_rh.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in bloodRHsList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Correo Electronico</label>
                                      <input class="form-control" type="text" v-model="post.mail" />
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="control-label">Telefono Fijo</label>
                                      <input class="form-control" type="text" v-model="post.number_phone" />
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label class="control-label">Telefono Movil</label>
                                      <input class="form-control" type="text" v-model="post.number_mobile" />
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">F. de ingreso</label>
                                      <input class="form-control" type="date" v-model="post.company_date_entry" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">F. de retiro</label>
                                      <input class="form-control" type="date" v-model="post.company_date_out" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Motivo Renuncia</label>
                                      <select class="form-control" v-model="post.reason_resignation.id">
                                          <option value="0">Seleccione una opcion.</option>
                                          <option v-bind:value="item.id" v-for="item in reasonResignationList">{{ item.name }}</option>
                                        </select>
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Correo Empresarial</label>
                                      <input class="form-control" type="text" v-model="post.company_mail" />
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Fijo/Extension</label>
                                      <input class="form-control" type="text" v-model="post.company_number_phone" />
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Móvil Empresarial</label>
                                      <input class="form-control" type="text" v-model="post.company_number_mobile" />
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Estado</label>
                                      <select class="form-control" v-model="post.status.id">
                                          <option value="0">Seleccione una opcion.</option>
                                          <option v-bind:value="item.id" v-for="item in statusEmployeeList">{{ item.name }}</option>
                                        </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">EPS</label>
                                      <select class="form-control" v-model="post.eps.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in epsList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">ARL</label>
                                      <select class="form-control" v-model="post.arl.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in arlList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Fondo Pensiones</label>
                                      <select class="form-control" v-model="post.pension_fund.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in pensionFundsList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Caja de compensacion</label>
                                      <select class="form-control" v-model="post.compensation_fund.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in compensationFundsList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Fondo de Cesantias</label>
                                      <select class="form-control" v-model="post.severance_fund.id">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in severanceFundsList">{{ item.name }}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Observaciones</label>
                                      <textarea class="form-control" v-model="post.observations"></textarea>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                  <div class="card card-default">
                      <div class="card-header">
                          <h4 class="card-title">
                              <i class="glyphicon glyphicon-lock text-gold"></i>
                              <b>CONTACTOS:</b>
                          </h4>
                      </div>
                      <div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-12">
                                    <router-link class="btn btn-success btn-xs" v-bind:to="{name: 'contact-add', params: {post_id: post.id}}"><i class="fa fa-plus-square"></i> Crear </router-link>

                                    <hr>
                                    <table class="table table-responsive">
                                      <tr>
                                        <th>Nombre Completo</th>
                                        <th>Identificacion</th>
                                        <th>Correo Electronico</th>
                                        <th>Numero de Telefono</th>
                                        <th>Numero de Movil</th>
                                        <th>Parentesco</th>
                                        <th>Observaciones</th>
                                        <th>Actions</th>
                                      </tr>
                                      <tr v-for="contact in post.contacts_employee">
                                        <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.surname }} {{ contact.second_surname }}</td>
                                        <td>{{ contact.identification_number }}</td>
                                        <td>{{ contact.mail }}</td>
                                        <td>{{ contact.number_phone }}</td>
                                        <td>{{ contact.number_mobile }}</td>
                                        <td>{{ contact.relationship }}</td>
                                        <td>{{ contact.description }}</td>
                                        <td>
                                          <router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'contact-edit', params: {post_id: post.id, contact_id: contact.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>
                                          <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'contact-delete', params: { post_id: post.id, contact_id: contact.id }}"><i class="fa fa-trash" aria-hidden="true"></i></router-link>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      <button type="submit" class="btn btn-success">Guardar</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="post-delete">
  <div>
    <h2>Delete post {{ post.id }}</h2>
    <form v-on:submit="deletepost">
      <p>The action cannot be undone.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
  </div>
</template>


<template id="contact-delete">
  <div>
    <h2>Eliminar contacto {{ contact_id }}</h2>
    <form v-on:submit="deletecontact">
      <p>Se va a eliminar el contacto permanentemente, confirme en el boton ROJO para eliminar.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
                <router-link class="btn btn-secundary" v-bind:to="'/post/' + employee_id + '/edit'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="contact-edit">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>EDITAR CONTACTO</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="updatecontact">
                                      <div class="row">
                                          <input type="hidden" class="form-control" v-model="contactData.id" />
                                          <input type="hidden" class="form-control" v-model="contactData.employee" />
                                        
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label"># Identificacion</label>
                                                  <input type="text" class="form-control" v-model="contactData.identification_number" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Nombre</label>
                                                  <input type="text" class="form-control" v-model="contactData.first_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Nombre</label>
                                                  <input type="text" class="form-control" v-model="contactData.second_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Apellido</label>
                                                  <input type="text" class="form-control" v-model="contactData.surname" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Apellido</label>
                                                  <input type="text" class="form-control" v-model="contactData.second_surname" />
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Correo Electronico</label>
                                                  <input type="text" class="form-control" v-model="contactData.mail" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Fijo</label>
                                                  <input type="text" class="form-control" v-model="contactData.number_phone" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Movil</label>
                                                  <input type="text" class="form-control" v-model="contactData.number_mobile" />
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Parentesco</label>
                                                  <input type="text" class="form-control" v-model="contactData.relationship" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="control-label">Descripcion</label>
                                                  <textarea class="form-control" v-model="contactData.description"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="pull-right">
                                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                                  <router-link class="btn btn-secundary" v-bind:to="'/post/' + employee_id + '/edit'">Cancelar</router-link>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="add-contact">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>NUEVO CONTACTO</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="createContact" method="POST">
                                        <div class="row">
                                          <input type="hidden" class="form-control" v-model="contactData.employee" />
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label"># Identificacion</label>
                                                  <input type="text" class="form-control" v-model="contactData.identification_number" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Nombre</label>
                                                  <input type="text" class="form-control" v-model="contactData.first_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Nombre</label>
                                                  <input type="text" class="form-control" v-model="contactData.second_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Apellido</label>
                                                  <input type="text" class="form-control" v-model="contactData.surname" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Apellido</label>
                                                  <input type="text" class="form-control" v-model="contactData.second_surname" />
                                              </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Correo Electronico</label>
                                                  <input type="text" class="form-control" v-model="contactData.mail" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Fijo</label>
                                                  <input type="text" class="form-control" v-model="contactData.number_phone" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Movil</label>
                                                  <input type="text" class="form-control" v-model="contactData.number_mobile" />
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Parentesco</label>
                                                  <input type="text" class="form-control" v-model="contactData.relationship" />
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Descripcion</label>
                                                    <textarea class="form-control" v-model="contactData.description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <router-link class="btn btn-secundary" v-bind:to="'/post/' + employee_id + '/edit'">Cancelar</router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
