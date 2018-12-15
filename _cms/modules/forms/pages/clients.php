<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Clientes</h1>
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
        <th>Tipo de cliente</th>
        <th>Tipo de identificacion</th>
        <th>Numero de identificacion</th>
        <th>Razon Social</th>
        <th>Nombre Comercial</th>
        <th>Tipo de Sociedad</th>
        <th>Departamento</th>
        <th>Ciudad</th>
        <th class="col-sm-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.client_type.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.identification_type.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.identification_number }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.social_reason }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.tradename }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.society_type.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.department_city.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.city.name }}</router-link></td>
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
    <form v-on:submit="createpost">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-default">
              <div class="card-header">
                  <h4 class="card-title">
                      <i class="glyphicon glyphicon-lock text-gold"></i>
                      <b>NUEVO CLIENTE:</b>
                  </h4>
              </div>
              <div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <p>Como parte del proceso de Monteverde LTDA, se solicita ingresar a todos los clientes y clientes potenciales. Agradecemos cualquier comentario y evaluación que le gustaría ofrecer sobre este cliente. Siéntase libre de adjuntar comentarios y/o descripciones.</p>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de cliente</label>
                                  <select class="form-control" v-model="post.client_type">
                                    <option value="" selected="selected">Seleccione una opcion.</option>
                                      <option v-bind:value="item.id" v-for="item in clientTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de identificacion</label>
                                  <select class="form-control" v-model="post.identification_type">
                                    <option value="" selected="selected">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in identificationTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label"># Identificacion</label>
                                  <input type="text" class="form-control" v-model="post.identification_number" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-5">
                              <div class="form-group">
                                  <label class="control-label">Razon Social</label>
                                  <input type="text" class="form-control" v-model="post.social_reason" />
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Nombre comercial</label>
                                  <input type="text" class="form-control" v-model="post.tradename" />
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Tipo de Sociedad</label>
                                  <select class="form-control" v-model="post.society_type">
                                    <option selected="selected">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in societyTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Departamento</label>
                                  <select class="form-control" v-model="post.department_city" @change="loadCityDepartment">
                                    <option value="" selected="selected">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in departmentsCitysList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Ciudad</label>
                                  <select class="form-control" v-model="post.city">
                                    <option selected="selected">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in citysList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Direccion Principal</label>
                                  <input type="text" class="form-control" v-model="post.address" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Fijo</label>
                                  <input type="text" class="form-control" v-model="post.phone" />
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Móvil</label>
                                  <input type="text" class="form-control" v-model="post.phone_mobile" />
                              </div>
                          </div>

                          <div class="col-md-5">
                              <label class="control-label">Correo Electronico</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.mail" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Observacion / Notas adiccionales</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <textarea class="form-control" v-model="post.comments"></textarea>
                              </div>
                          </div>
                      </div>

                    <!--
                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Campo para Adjuntos</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Por favor, marque la casilla apropiada para las aprobaciones el cliente:</label>

                              <table class="table table-primary">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>SMS</th>
                                          <th>TELEFONO</th>
                                          <th>CORREO ELECTRONICO</th>
                                          <th>CORREO FISICO</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Monteverde LTDA</td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                      <tr>
                                          <td>Empresas Aliadas y Terceros Monteverde LTDA</td>
                                          <td><input type="checkbox"></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                      <tr>
                                          <td>Campañas Marketin (Terceros)</td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                  </tbody>

                              </table>
                              <label class="control-label">Comentarios (por favor siéntase libre de adjuntar una carta u otra documentación):</label>
                              <textarea rows="6" class="form-control"></textarea>
                          </div>
                      </div>
                    -->
                      <br />


                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                <button type="submit" class="btn btn-success">Crear</button>
                                <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
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
                        <b>INFORMACION DEL CLIENTE: # {{ post.id }}</b>
                    </h4>
                </div>
                <div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Como parte del proceso de Monteverde LTDA, se solicita ingresar a todos los clientes y clientes potenciales. Agradecemos cualquier comentario y evaluación que le gustaría ofrecer sobre este cliente. Siéntase libre de adjuntar comentarios y/o descripciones.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipo de cliente</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option value="">{{ post.client_type.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipo de identificacion</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option value="">{{ post.identification_type.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"># Identificacion</label>
                                    <input type="text" class="form-control" v-model="post.identification_number" readonly="" disabled="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Razon Social</label>
                                    <input type="text" class="form-control" v-model="post.social_reason" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nombre comercial</label>
                                    <input type="text" class="form-control" v-model="post.tradename" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tipo de Sociedad</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option value="">{{ post.society_type.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Departamento</label>
                                    <select class="form-control" readonly="" disabled="">
                                      <option value="">{{ post.department_city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Ciudad</label>
                                    <select class="form-control" readonly="" disabled="">
                                        <option value="">{{ post.city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Direccion Principal</label>
                                    <input type="text" class="form-control" v-model="post.address" readonly="" disabled="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Teléfono Fijo</label>
                                    <input type="text" class="form-control" v-model="post.phone" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Teléfono Móvil</label>
                                    <input type="text" class="form-control" v-model="post.phone_mobile" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="control-label">Correo Electronico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control" v-model="post.mail" readonly="" disabled="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label">Campo para Adjuntos</label>
                                <textarea class="form-control" v-model="post.comments" readonly="" disabled="" />
                                </textarea>
                            </div>
                        </div>

                      <!--
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label">Por favor, marque la casilla apropiada para las aprobaciones el cliente:</label>

                                <table class="table table-primary">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>SMS</th>
                                            <th>TELEFONO</th>
                                            <th>CORREO ELECTRONICO</th>
                                            <th>CORREO FISICO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monteverde LTDA</td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                        </tr>
                                        <tr>
                                            <td>Empresas Aliadas y Terceros Monteverde LTDA</td>
                                            <td><input type="checkbox"></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                        </tr>
                                        <tr>
                                            <td>Campañas Marketin (Terceros)</td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                            <td><label class="control-label"><input type="checkbox"></label></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <label class="control-label">Comentarios (por favor siéntase libre de adjuntar una carta u otra documentación):</label>
                                <textarea rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                      -->
                        <br />


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                  <router-link v-bind:to="'/'" class="btn btn-primary btn-lg">Volver a la lista de mensajes</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                      <b>MODIFICAR CLIENTE:</b>
                  </h4>
              </div>
              <div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <p>Como parte del proceso de Monteverde LTDA, se solicita ingresar a todos los clientes y clientes potenciales. Agradecemos cualquier comentario y evaluación que le gustaría ofrecer sobre este cliente. Siéntase libre de adjuntar comentarios y/o descripciones.</p>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de cliente</label>
                                  <select class="form-control" v-model="post.client_type.id">
                                    <option v-bind:value="item.id" v-for="item in clientTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de identificacion</label>
                                  <select class="form-control" v-model="post.identification_type.id">
                                    <option v-bind:value="item.id" v-for="item in identificationTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label"># Identificacion</label>
                                  <input type="text" class="form-control" v-model="post.identification_number" />
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-5">
                              <div class="form-group">
                                  <label class="control-label">Razon Social</label>
                                  <input type="text" class="form-control" v-model="post.social_reason" />
                              </div>
                          </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Nombre comercial</label>
                                  <input type="text" class="form-control" v-model="post.tradename" />
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Tipo de Sociedad</label>
                                  <select class="form-control" v-model="post.society_type.id">
                                    <option v-bind:value="item.id" v-for="item in societyTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Departamento</label>
                                  <select class="form-control" v-model="post.department_city.id">
                                    <option v-bind:value="item.id" v-for="item in departmentsCitysList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Ciudad</label>
                                  <select class="form-control" v-model="post.city.id">
                                    <option v-bind:value="item.id" v-for="item in citysList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Direccion Principal</label>
                                  <input type="text" class="form-control" v-model="post.address" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Fijo</label>
                                  <input type="text" class="form-control" v-model="post.phone" />
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Móvil</label>
                                  <input type="text" class="form-control" v-model="post.phone_mobile" />
                              </div>
                          </div>

                          <div class="col-md-5">
                              <label class="control-label">Correo Electronico</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.mail" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Observacion / Notas adiccionales</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <textarea class="form-control" v-model="post.comments"></textarea>
                              </div>
                          </div>
                      </div>
                    <!--
                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Campo para Adjuntos</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <br>
                                  <br>
                                  <br>
                                  <br>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="control-label">Por favor, marque la casilla apropiada para las aprobaciones el cliente:</label>

                              <table class="table table-primary">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>SMS</th>
                                          <th>TELEFONO</th>
                                          <th>CORREO ELECTRONICO</th>
                                          <th>CORREO FISICO</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Monteverde LTDA</td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                      <tr>
                                          <td>Empresas Aliadas y Terceros Monteverde LTDA</td>
                                          <td><input type="checkbox"></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                      <tr>
                                          <td>Campañas Marketin (Terceros)</td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                          <td><label class="control-label"><input type="checkbox"></label></td>
                                      </tr>
                                  </tbody>

                              </table>
                              <label class="control-label">Comentarios (por favor siéntase libre de adjuntar una carta u otra documentación):</label>
                              <textarea rows="6" class="form-control"></textarea>
                          </div>
                      </div>
                    -->
                      <br />


                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                  <router-link class="btn btn-secundary" v-bind:to="'/'">Cancelar</router-link>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
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
