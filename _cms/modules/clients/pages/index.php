<div class="container_">
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
          <router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'post-edit', params: {post_id: post.id}}"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>
          <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'post-delete', params: {post_id: post.id}}"><i class="fa fa-trash" aria-hidden="true"></i></router-link>
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
                                    <option value="0">Seleccione una opcion.</option>
                                      <option v-bind:value="item.id" v-for="item in clientTypesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de identificacion</label>
                                  <select class="form-control" v-model="post.identification_type">
                                    <option value="0">Seleccione una opcion.</option>
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
                                    <option value="0">Seleccione una opcion.</option>
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
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in departmentsCitysList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Ciudad</label>
                                  <select class="form-control" v-model="post.city">
                                    <option value="0">Seleccione una opcion.</option>
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

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Móvil</label>
                                  <input type="text" class="form-control" v-model="post.phone_mobile" />
                              </div>
                          </div>

                          <div class="col-md-3">
                              <label class="control-label">Correo Electronico</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.mail" />
                              </div>
                          </div>
                        
                          <div class="col-md-3">
                              <label class="control-label">Representante Legal</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.legal_representative" />
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
                                              </div>
                                              <div class="col-lg-12">
                                                Antes de agregar los contactos debes crear el cliente
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">Crear</button>
                                    <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
                                </div>
                                <br>
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
                        <b>INFORMACION BASICA</b>
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Teléfono Móvil</label>
                                    <input type="text" class="form-control" v-model="post.phone_mobile" readonly="" disabled="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Correo Electronico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control" v-model="post.mail" readonly="" disabled="" />
                                </div>
                            </div>
                          
                            <div class="col-md-3">
                                <label class="control-label">Representante Legal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control" v-model="post.legal_representative" readonly="" disabled=""  />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <label class="control-label">Comentarios / Observacion</label>
                                <textarea class="form-control" v-model="post.comments" readonly="" disabled=""></textarea>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">Habilitar interventoria</label>
                                <select class="form-control" v-model="post.enable_audit" readonly="" disabled="">
                                    <option value="0">Desabilitado</option>
                                    <option value="1">Habilitado</option>
                                </select>
                                
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
                                          <table class="table table-responsive">
                                            <tr>
                                              <th>Nombre Completo</th>
                                              <th>Identificacion</th>
                                              <th>Correo Electronico</th>
                                              <th>Numero de Telefono</th>
                                              <th>Numero de Movil</th>
                                              <th>Cargo</th>
                                              <th>Area</th>
                                              <th>Observaciones</th>
                                            </tr>
                                            <tr v-for="contact in post.contacts_clients">
                                              <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.surname }} {{ contact.second_surname }}</td>
                                              <td>{{ contact.identification_number }}</td>
                                              <td>{{ contact.mail }}</td>
                                              <td>{{ contact.number_phone }}</td>
                                              <td>{{ contact.number_mobile }}</td>
                                              <td>{{ contact.charge }}</td>
                                              <td>{{ contact.area }}</td>
                                              <td>{{ contact.description }}</td>
                                            </tr>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="card card-default" v-if="post.enable_audit == 1">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="glyphicon glyphicon-lock text-gold"></i>
                                    <b>INTERVENTORES</b>
                                </h4>
                            </div>
                            <div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                          <table class="table table-responsive">
                                            <tr>
                                              <th>Nombre Completo</th>
                                              <th>Identificacion</th>
                                              <th>Correo Electronico</th>
                                              <th>Numero de Telefono</th>
                                              <th>Numero de Movil</th>
                                              <th>Cargo</th>
                                              <th>Area</th>
                                              <th>Observaciones</th>
                                            </tr>
                                            <tr v-for="contact in post.inspectors_clients">
                                              <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.surname }} {{ contact.second_surname }}</td>
                                              <td>{{ contact.identification_number }}</td>
                                              <td>{{ contact.mail }}</td>
                                              <td>{{ contact.number_phone }}</td>
                                              <td>{{ contact.number_mobile }}</td>
                                              <td>{{ contact.charge }}</td>
                                              <td>{{ contact.area }}</td>
                                              <td>{{ contact.description }}</td>
                                            </tr>
                                          </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					<br />
					<div class="row">
						<div class="col-lg-12">
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<i class="glyphicon glyphicon-lock text-gold"></i>
										<b>CONTRATOS</b>
									</h4>
								</div>
								<div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12">
												<table class="table table-responsive">
													<tr>
														<th>ID MV</th>
														<th>consecutive</th>
														<th>name</th>
														<th>objective</th>
														<th>client</th>
														<th>description_service</th>
														<th>date_start</th>
														<th>date_end</th>
														<th>observations</th>
													</tr>
													<tr v-for="contract in post.contracts_clients">
														<td>{{ contract.id }}</td>
														<td>{{ contract.consecutive }}</td>
														<td>{{ contract.number }}</td>
														<td>{{ contract.objective }}</td>
														<td>{{ contract.client }}</td>
														<td>{{ contract.description_service }}</td>
														<td>{{ contract.date_start }}</td>
														<td>{{ contract.date_end }}</td>
														<td>{{ contract.observations }}</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

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
                      <b>INFORMACION BASICA</b>
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

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="control-label">Teléfono Móvil</label>
                                  <input type="text" class="form-control" v-model="post.phone_mobile" />
                              </div>
                          </div>

                          <div class="col-md-3">
                              <label class="control-label">Correo Electronico</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.mail" />
                              </div>
                          </div>
                        
                          <div class="col-md-3">
                              <label class="control-label">Representante Legal</label>
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                  <input type="text" class="form-control" v-model="post.legal_representative" />
                              </div>
                          </div>                        
                      </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <label class="control-label">Comentarios / Observacion</label>
                            <textarea class="form-control" v-model="post.comments"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label class="control-label">Habilitar interventoria</label>
                            <select class="form-control" v-model="post.enable_audit" >
                                <option value="0">Desabilitado</option>
                                <option value="1">Habilitado</option>
                            </select>
                            
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
                                                      <th>Cargo</th>
                                                      <th>Area</th>
                                                      <th>Observaciones</th>
                                                      <th>Actions</th>
                                                    </tr>
                                                    <tr v-for="contact in post.contacts_clients">
                                                      <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.surname }} {{ contact.second_surname }}</td>
                                                      <td>{{ contact.identification_number }}</td>
                                                      <td>{{ contact.mail }}</td>
                                                      <td>{{ contact.number_phone }}</td>
                                                      <td>{{ contact.number_mobile }}</td>
                                                      <td>{{ contact.charge }}</td>
                                                      <td>{{ contact.area }}</td>
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
                        
                        
                      <br />
                      <div class="row" v-if="post.enable_audit == 1">
                          <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <i class="glyphicon glyphicon-lock text-gold"></i>
                                            <b>INTERVENTORES</b>
                                        </h4>
                                    </div>
                                    <div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                  <router-link class="btn btn-success btn-xs" v-bind:to="{name: 'inspector-add', params: {post_id: post.id}}"><i class="fa fa-plus-square"></i> Crear </router-link>
                                                  <hr>
                                                  <table class="table table-responsive">
                                                    <tr>
                                                      <th>Nombre Completo</th>
                                                      <th>Identificacion</th>
                                                      <th>Correo Electronico</th>
                                                      <th>Numero de Telefono</th>
                                                      <th>Numero de Movil</th>
                                                      <th>Cargo</th>
                                                      <th>Area</th>
                                                      <th>Observaciones</th>
                                                      <th>Actions</th>
                                                    </tr>
                                                    <tr v-for="inspector in post.inspectors_clients">
                                                      <td>{{ inspector.first_name }} {{ inspector.second_name }} {{ inspector.surname }} {{ inspector.second_surname }}</td>
                                                      <td>{{ inspector.identification_number }}</td>
                                                      <td>{{ inspector.mail }}</td>
                                                      <td>{{ inspector.number_phone }}</td>
                                                      <td>{{ inspector.number_mobile }}</td>
                                                      <td>{{ inspector.charge }}</td>
                                                      <td>{{ inspector.area }}</td>
                                                      <td>{{ inspector.description }}</td>
                                                      <td>
                                                        <router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'inspector-edit', params: {post_id: post.id, inspector_id: inspector.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>
                                                        <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'inspector-delete', params: { post_id: post.id, inspector_id: inspector.id }}"><i class="fa fa-trash" aria-hidden="true"></i></router-link>
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


					<br />
					<div class="row">
						<div class="col-lg-12">
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<i class="glyphicon glyphicon-lock text-gold"></i>
										<b>CONTRATOS</b>
									</h4>
								</div>
								<div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12">
												<router-link class="btn btn-success btn-xs" v-bind:to="{name: 'contract-add', params: {post_id: post.id}}"><i class="fa fa-plus-square"></i> Crear </router-link>
												<hr>
												<table class="table table-responsive">
													<tr>
														<th>ID MV</th>
														<th>consecutive</th>
														<th>name</th>
														<th>objective</th>
														<th>client</th>
														<th>description_service</th>
														<th>date_start</th>
														<th>date_end</th>
														<th>observations</th>
														<th>Actions</th>
													</tr>
													<tr v-for="contract in post.contracts_clients">
														<td>{{ contract.id }}</td>
														<td>{{ contract.consecutive }}</td>
														<td>{{ contract.number }}</td>
														<td>{{ contract.objective }}</td>
														<td>{{ contract.client }}</td>
														<td>{{ contract.description_service }}</td>
														<td>{{ contract.date_start }}</td>
														<td>{{ contract.date_end }}</td>
														<td>{{ contract.observations }}</td>
														<td>
															<router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'contract-edit', params: {post_id: post.id, contract_id: contract.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></router-link>
															<router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'contract-delete', params: { post_id: post.id, contract_id: contract.id }}"><i class="fa fa-trash" aria-hidden="true"></i></router-link>
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
					<br />
					<div class="row">
						<div class="col-lg-12">
							<div class="card card-default">
								<div class="card-header">
									<h4 class="card-title">
										<i class="glyphicon glyphicon-lock text-gold"></i>
										<b>SERVICIOS</b>
									</h4>
								</div>
								<div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12">
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                <br>
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                  <router-link class="btn btn-secundary" v-bind:to="'/'">Cancelar</router-link>
                                <br>
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
                                          <input type="hidden" class="form-control" v-model="clientData.client" />
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label"># Identificacion</label>
                                                  <input type="text" class="form-control" v-model="clientData.identification_number" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Nombre</label>
                                                  <input type="text" class="form-control" v-model="clientData.first_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Nombre</label>
                                                  <input type="text" class="form-control" v-model="clientData.second_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Apellido</label>
                                                  <input type="text" class="form-control" v-model="clientData.surname" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Apellido</label>
                                                  <input type="text" class="form-control" v-model="clientData.second_surname" />
                                              </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Correo Electronico</label>
                                                  <input type="text" class="form-control" v-model="clientData.mail" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Fijo</label>
                                                  <input type="text" class="form-control" v-model="clientData.number_phone" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Movil</label>
                                                  <input type="text" class="form-control" v-model="clientData.number_mobile" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Cargo</label>
                                                  <input type="text" class="form-control" v-model="clientData.charge" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Area</label>
                                                  <input type="text" class="form-control" v-model="clientData.area" />
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Descripcion</label>
                                                    <textarea class="form-control" v-model="clientData.description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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

<template id="post-delete">
  <div>
    <h2>Eliminar Cliente {{ post.id }}</h2>
    <form v-on:submit="deletepost">
      <p>Se va a eliminar el cliente permanentemente, confirme en el boton ROJO para eliminar.</p>
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
                <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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
                                          <input type="hidden" class="form-control" v-model="contactData.client" />
                                        
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
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Cargo</label>
                                                  <input type="text" class="form-control" v-model="contactData.charge" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Area</label>
                                                  <input type="text" class="form-control" v-model="contactData.area" />
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
                                                  <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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

<template id="add-inspector">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>NUEVO inspector</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="createinspector" method="POST">
                                        <div class="row">
                                          <input type="hidden" class="form-control" v-model="inspectorData.client" />
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label"># Identificacion</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.identification_number" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Nombre</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.first_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Nombre</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.second_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Apellido</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.surname" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Apellido</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.second_surname" />
                                              </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Correo Electronico</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.mail" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Fijo</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.number_phone" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Movil</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.number_mobile" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Cargo</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.charge" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Area</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.area" />
                                              </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Descripcion</label>
                                                    <textarea class="form-control" v-model="inspectorData.description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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

<template id="inspector-delete">
  <div>
    <h2>Eliminar inspector {{ inspector_id }}</h2>
    <form v-on:submit="deleteinspector">
      <p>Se va a eliminar el inspector permanentemente, confirme en el boton ROJO para eliminar.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
                <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="inspector-edit">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>EDITAR inspector</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="updateinspector">
                                      <div class="row">
                                          <input type="hidden" class="form-control" v-model="inspectorData.id" />
                                          <input type="hidden" class="form-control" v-model="inspectorData.client" />
                                        
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label"># Identificacion</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.identification_number" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Nombre</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.first_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Nombre</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.second_name" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Primer Apellido</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.surname" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Segundo Apellido</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.second_surname" />
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label class="control-label">Correo Electronico</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.mail" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Fijo</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.number_phone" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Teléfono Movil</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.number_mobile" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Cargo</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.charge" />
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label class="control-label">Area</label>
                                                  <input type="text" class="form-control" v-model="inspectorData.area" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label class="control-label">Descripcion</label>
                                                  <textarea class="form-control" v-model="inspectorData.description"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="pull-right">
                                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                                  <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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


<template id="add-contract">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>NUEVO contrato</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="createcontract" method="POST">
                                        <div class="row">
                                          	<input type="hidden" class="form-control" v-model="contractData.client" />
                                          	<div class="col-md-4">
                                              	<div class="form-group">
                                                  	<label class="control-label"># Contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.number" />
                                              	</div>
                                          	</div>
                                         	<div class="col-md-4">
                                            	<div class="form-group">
                                                	<label class="control-label">Consecutivo del contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.consecutive" />
                                              	</div>
                                          	</div>
                                         	<div class="col-md-4">
                                            	<div class="form-group">
                                                	<label class="control-label">Titulo / Nombre del contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.name" />
                                              	</div>
                                          	</div>
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Objetivo del Contrato</label>
													<textarea rows="10" class="form-control" v-model="contractData.objective"></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Descripcion del Servicio</label>
													<textarea rows="10" class="form-control" v-model="contractData.description_service"></textarea>
												</div>
											</div>
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Fecha de Inicio</label>
													<input type="date" class="form-control" v-model="contractData.date_start" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Fecha de Termino</label>
													<input type="date" class="form-control" v-model="contractData.date_end" />
												</div>
											</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Observaciones</label>
                                                    <textarea rows="10" class="form-control" v-model="contractData.observations"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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

<template id="contract-delete">
  <div>
    <h2>Eliminar contract {{ contract_id }}</h2>
    <form v-on:submit="deletecontract">
      <p>Se va a eliminar el contract permanentemente, confirme en el boton ROJO para eliminar.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
                <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="contract-edit">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="glyphicon glyphicon-lock text-gold"></i>
                            <b>EDITAR contract</b>
                        </h4>
                    </div>
                    <div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form v-on:submit="updatecontract">
										<div class="row">
                                        	<input type="hidden" class="form-control" v-model="contractData.id" />
                                          	<input type="hidden" class="form-control" v-model="contractData.client" />
                                          	<div class="col-md-4">
                                              	<div class="form-group">
                                                  	<label class="control-label"># Contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.number" />
                                              	</div>
                                          	</div>
                                         	<div class="col-md-4">
                                            	<div class="form-group">
                                                	<label class="control-label">Consecutivo del contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.consecutive" />
                                              	</div>
                                          	</div>
                                         	<div class="col-md-4">
                                            	<div class="form-group">
                                                	<label class="control-label">Titulo / Nombre del contrato</label>
                                                  	<input type="text" class="form-control" v-model="contractData.name" />
                                              	</div>
                                          	</div>
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Objetivo del Contrato</label>
													<textarea rows="10" class="form-control" v-model="contractData.objective"></textarea>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Descripcion del Servicio</label>
													<textarea rows="10" class="form-control" v-model="contractData.description_service"></textarea>
												</div>
											</div>
                                        </div>
                                        <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Fecha de Inicio</label>
													<input type="date" class="form-control" v-model="contractData.date_start" />
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Fecha de Termino</label>
													<input type="date" class="form-control" v-model="contractData.date_end" />
												</div>
											</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Observaciones</label>
                                                    <textarea rows="10" class="form-control" v-model="contractData.observations"></textarea>
                                                </div>
                                            </div>
                                        </div>
										
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="pull-right">
                                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                                  <router-link class="btn btn-secundary" v-bind:to="'/post/' + client_id + '/edit'">Cancelar</router-link>
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

