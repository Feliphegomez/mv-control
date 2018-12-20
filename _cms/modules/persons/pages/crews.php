<div class="container">
	<header class="page-header">
		<div class="branding">
			<img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
			<h1>Cuadrillas</h1>
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
					<th>Codigo</th>
					<th>Supervisor</th>
					<th>Supervisor (E)</th>
					<th >Actions</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr v-if="posts===null">
        			<td colspan="4">Loading...</td>
      			</tr>
      			<tr v-else v-for="post in filteredposts">
					<td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
					<td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.code }}</router-link></td>
					<td>
						<router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">
						{{ post.supervisor.first_name }} {{ post.supervisor.second_name }} {{ post.supervisor.surname }} {{ post.supervisor.second_surname }}
						</router-link>
					</td>
					<td>
						<router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">
						{{ post.supervisor_e.first_name }} {{ post.supervisor_e.second_name }} {{ post.supervisor_e.surname }} {{ post.supervisor_e.second_surname }}
						</router-link>
					</td>
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
		<div class="card card-default">
			<div class="card-header">
				<h4 class="card-title">
					<i class="glyphicon glyphicon-lock text-gold"></i>
					<b>Informacion Básica:</b>
				</h4>
			</div>
			<div class="card-body">
				<form v-on:submit="createpost">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="add-content">Codigo</label>
								<input class="form-control" type="text" id="add-content" v-model="post.code" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Supervisor</label>
								<select class="form-control" v-model="post.supervisor">
									<option value="0">Seleccione una opcion.</option>
									<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Supervisor (E)</label>
								<select class="form-control" v-model="post.supervisor_e">
									<option value="0">Seleccione una opcion.</option>
									<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Crear</button>
							<router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<template id="post">
 	<div>
		<div class="card card-default">
			<div class="card-header">
				<h4 class="card-title">
					<i class="glyphicon glyphicon-lock text-gold"></i>
					<b>Informacion Básica:</b>
				</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="add-content">Codigo</label>
							<input class="form-control" type="text" id="add-content" v-model="post.code" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Supervisor</label>
							<select class="form-control" v-model="post.supervisor.id">
								<option value="0">Seleccione una opcion.</option>
								<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Supervisor (E)</label>
							<select class="form-control" v-model="post.supervisor_e.id">
								<option value="0">Seleccione una opcion.</option>
								<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
							</select>
						</div>
					</div>

					<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Crear</button>
						<router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
					</div>
				</div>
			</div>
 		</div>
		<br>
		<div class="card card-default">
			<div class="card-header">
				<h4 class="card-title">
					<i class="glyphicon glyphicon-lock text-gold"></i>
					<b>Integrantes:</b>
				</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-responsive">
							<tr>
								<th>Cargo</th>
								<th>Nombre</th>
								<th></th>
							</tr>
							<tr v-for="charge in post.crew_employee">
								<td>{{ charge.charge.name }} </td>
								<td>
									<select class="form-control" v-model="charge.employee" disabled="">
										<option value="0">Seleccione una opcion.</option>
										<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
									</select>
								</td>
							</tr>
						</table>
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
		<div class="card card-default">
			<div class="card-header">
				<h4 class="card-title">
					<i class="glyphicon glyphicon-lock text-gold"></i>
					<b>Informacion Básica:</b>
				</h4>
			</div>
			<div class="card-body">
				<form v-on:submit="updatepost">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="add-content">Codigo</label>
								<input class="form-control" type="text" id="add-content" v-model="post.code" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Supervisor</label>
								<select class="form-control" v-model="post.supervisor.id">
									<option value="0">Seleccione una opcion.</option>
									<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Supervisor (E)</label>
								<select class="form-control" v-model="post.supervisor_e.id">
									<option value="0">Seleccione una opcion.</option>
									<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Guardar</button>
							<router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
						</div>
					</div>
				</form>
			</div>
  		</div>
		<br>
		<div class="card card-default">
			<div class="card-header">
				<h4 class="card-title">
					<i class="glyphicon glyphicon-lock text-gold"></i>
					<b>Integrantes:</b>
				</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<router-link class="btn btn-success btn-xs" v-bind:to="{name: 'crew-add', params: {post_id: post.id}}">
							<i class="fa fa-plus-square"></i> Crear 
						</router-link>
						<table class="table table-responsive">
							<tr>
								<th>Cargo</th>
								<th>Nombre</th>
								<th></th>
							</tr>
							<tr v-for="crew in post.crew_employee">
								<td>{{ crew.charge.name }} </td>
								<td>
									<select class="form-control" v-model="crew.employee" disabled="">
										<option value="0">Seleccione una opcion.</option>
										<option v-bind:value="item.id" v-for="item in employeeList">{{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
									</select>
								</td>
								<td>
								   <router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'crew-delete', params: {post_id: post.id, crew_id: crew.id }}">
										<i class="fa fa-trash"></i> Eliminar
									</router-link>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
  		</div>
  	</div>
</template>


<template id="add-crew">
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
                                      <label class="control-label">Cuadrilla</label>
                                      <select class="form-control" v-model="post.crew" disabled="">
                                        <option value="0">Seleccione una opcion.</option>
                                        <option v-bind:value="item.id" v-for="item in crewList">{{ item.code }}</option>
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

<template id="crew-delete">
  <div>
    <h2>Eliminar {{ crew_id }}</h2>
    <form v-on:submit="deletepost" method="POST">
      <p>Se va a eliminar el conductor de manera permanente.</p>
      <button type="submit" class="btn btn-danger">Eliminar</button>
      <router-link class="btn btn-primary" v-bind:to="'/post/' + post_id + '/edit'">Cancelar</router-link>
    </form>
  </div>
</template>

