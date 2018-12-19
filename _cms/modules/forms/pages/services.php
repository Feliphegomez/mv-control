<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Servicios</h1>
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
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Unidad de Medida</th>
        <th>Precio</th>
        <th class="col-sm-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.category.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.payment_type.name }} - {{ post.payment_type.title }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.price }}</router-link></td>
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
                      <b>NUEVO:</b>
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
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Nombre </label>
                                  <input type="text" class="form-control" v-model="post.name" />
                              </div>
                          </div>
                        
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Categoria</label>
                                  <select class="form-control" v-model="post.category">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in categoriesServicesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Unidad de medida</label>
                                  <select class="form-control" v-model="post.payment_type">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in paymentsTypesList">{{ item.name }} - {{ item.title }}</option>
                                  </select>
                              </div>
                          </div>
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Precio</label>
                                  <input type="text" class="form-control" v-model="post.price" />
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label class="control-label">Descripcion</label>
                                  <textarea type="text" class="form-control" v-model="post.description"></textarea>
                              </div>
                          </div>
                      </div>
                      
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
                        <b>VER</b>
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
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Nombre </label>
                                  <input type="text" class="form-control" v-model="post.name" disabled="" readonly="" />
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Categoria</label>
                                  <select class="form-control" disabled="" readonly="">
                                    <option value="" >{{ post.category.name }}</option>
                                  </select>
                              </div>
                          </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de cobro</label>
                                  <select class="form-control" disabled="" readonly="">
                                    <option value="" >{{ post.payment_type.name }} - {{ post.payment_type.title }}</option>
                                  </select>
                              </div>
                          </div>
                          
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="control-label">Precio</label>
                                  <input type="text" class="form-control" v-model="post.price" disabled="" readonly="" />
                              </div>
                          </div>
                        </div>
                        
                        
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="form-group">
                                  <label class="control-label">Descripcion</label>
                                  <textarea type="text" class="form-control" v-model="post.description" disabled="" readonly=""></textarea>
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
                      <b>MODIFICAR:</b>
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
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Nombre </label>
                                  <input type="text" class="form-control" v-model="post.name" />
                              </div>
                          </div>

                        
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Categoria</label>
                                  <select class="form-control" v-model="post.category.id">
                                    <option value="0">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in categoriesServicesList">{{ item.name }}</option>
                                  </select>
                              </div>
                          </div>
                        
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Tipo de cobro</label>
                                  <select class="form-control" v-model="post.payment_type.id">
                                    <option value="" selected="selected">Seleccione una opcion.</option>
                                    <option v-bind:value="item.id" v-for="item in paymentsTypesList">{{ item.name }} - {{ item.title }}</option>
                                  </select>
                              </div>
                          </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label class="control-label">Precio</label>
                                  <input type="text" class="form-control" v-model="post.price" />
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group">
                                  <label class="control-label">Descripcion</label>
                                  <textarea type="text" class="form-control" v-model="post.description"></textarea>
                              </div>
                          </div>
                      </div>
                      
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
