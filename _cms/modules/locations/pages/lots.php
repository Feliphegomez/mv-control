<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Lotes</h1>
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
    <table class="table table-responsive" widht="100%">
      <thead>
      <tr>
        <th>ID</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th class="col-sm-2">Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.code }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.name }}</router-link></td>
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
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Codigo</label>
            <input class="form-control" type="text" id="add-content" v-model="post.code" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Nombre</label>
            <input class="form-control" type="text" id="add-content" v-model="post.name" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Categoria</label>
            <select class="form-control" v-model="post.category">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in categoryLotsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Zona</label>
            <select class="form-control" v-model="post.zone">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in zonesList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Unidad de Medida</label>
            <select class="form-control" v-model="post.payment_type">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in paymentsTypesList">{{ item.name }} - {{ item.title }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Quincena</label>
            <select class="form-control" v-model="post.fortnight">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in fortnightsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Estado</label>
            <select class="form-control" v-model="post.status_registration">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in statusRegistrationsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Area</label>
            <input class="form-control" type="text" id="add-content" v-model="post.area" />
          </div>
        </div>
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
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Direccion</label>
            <textarea class="form-control" type="text" id="add-content" v-model="addressRepair" @change="searchAddressMaps"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Normalizar Direccion</label>
            <textarea class="form-control" type="text" id="add-content" v-model="post.address" disabled="" readonly=""></textarea>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Latitud</label>
            <input class="form-control" type="text" id="add-content" v-model="post.latitude" readonly="" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Longitud</label>
            <input class="form-control" type="text" id="add-content" v-model="post.longitude" readonly="" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Descripcion</label>
            <textarea class="form-control" type="text" id="add-content" v-model="post.description"></textarea>
          </div>
          </div>
        </div>
      
        <div class="col-md-12">
          <div class="form-group">
            <label for="add-content">Mapa</label>
            <iframe marginheight="0" marginwidth="0" v-bind:src="'//www.openstreetmap.org/export/embed.html?marker=' + post.latitude + ',' + post.longitude + '&bbox=' + post.longitude + ',' + post.latitude" 
            scrolling="no" frameborder="0" height="500" width="700"> 
            </iframe>
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
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Codigo</label>
            <input class="form-control" type="text" id="add-content" v-model="post.code" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Nombre</label>
            <input class="form-control" type="text" id="add-content" v-model="post.name" />
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Categoria</label>
            <select class="form-control" v-model="post.category">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in categoryLotsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Zona</label>
            <select class="form-control" v-model="post.zone">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in zonesList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Unidad de Medida</label>
            <select class="form-control" v-model="post.payment_type">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in paymentsTypesList">{{ item.name }} - {{ item.title }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Quincena</label>
            <select class="form-control" v-model="post.fortnight">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in fortnightsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="add-content">Estado</label>
            <select class="form-control" v-model="post.status_registration">
              <option value="0">Seleccione una opcion.</option>
              <option v-bind:value="item.id" v-for="item in statusRegistrationsList">{{ item.name }}</option>
            </select>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Area</label>
            <input class="form-control" type="text" id="add-content" v-model="post.area" />
          </div>
        </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label class="control-label">Departamento</label>
                  <select class="form-control" v-model="post.department_city">
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
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Direccion</label>
            <textarea class="form-control" type="text" id="add-content" v-model="post.address" disabled="" readonly=""></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="add-content">Descripcion</label>
            <textarea class="form-control" type="text" id="add-content" v-model="post.description"></textarea>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Latitud</label>
            <input class="form-control" type="text" id="add-content" v-model="post.latitude" readonly="" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="add-content">Longitud</label>
            <input class="form-control" type="text" id="add-content" v-model="post.longitude" readonly="" />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="add-content">Mapa</label>
            <iframe marginheight="0" marginwidth="0" v-bind:src="'//www.openstreetmap.org/export/embed.html?marker=' + post.latitude + ',' + post.longitude + '&bbox=' + post.longitude + ',' + post.latitude" 
            scrolling="no" frameborder="0" height="500" width="700"> 
            </iframe>
          </div>
        </div>
      </div>
      
    <br/>
    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
    <router-link class="btn btn-primary" v-bind:to="'/'">Volver a la lista de mensajes</router-link>
  </div>
</template>

<template id="post-edit">
  <div>
    <h2>Modificar</h2>
    <form v-on:submit="updatepost">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Codigo</label>
          <input class="form-control" type="text" id="add-content" v-model="post.code" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="add-content">Nombre</label>
          <input class="form-control" type="text" id="add-content" v-model="post.name" />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Categoria</label>
          <select class="form-control" v-model="post.category">
            <option value="0">Seleccione una opcion.</option>
            <option v-bind:value="item.id" v-for="item in categoryLotsList">{{ item.name }}</option>
          </select>
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Zona</label>
          <select class="form-control" v-model="post.zone">
            <option value="0">Seleccione una opcion.</option>
            <option v-bind:value="item.id" v-for="item in zonesList">{{ item.name }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Unidad de Medida</label>
          <select class="form-control" v-model="post.payment_type">
            <option value="0">Seleccione una opcion.</option>
            <option v-bind:value="item.id" v-for="item in paymentsTypesList">{{ item.name }} - {{ item.title }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Quincena</label>
          <select class="form-control" v-model="post.fortnight">
            <option value="0">Seleccione una opcion.</option>
            <option v-bind:value="item.id" v-for="item in fortnightsList">{{ item.name }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="add-content">Estado</label>
          <select class="form-control" v-model="post.status_registration">
            <option value="0">Seleccione una opcion.</option>
            <option v-bind:value="item.id" v-for="item in statusRegistrationsList">{{ item.name }}</option>
          </select>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="add-content">Area</label>
          <input class="form-control" type="text" id="add-content" v-model="post.area" />
        </div>
      </div>
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
      
      <div class="col-md-6">
        <div class="form-group">
          <label for="add-content">Direccion</label>
          <textarea class="form-control" type="text" id="add-content" v-model="addressRepair" @change="searchAddressMaps"></textarea>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="add-content">Normalizar Direccion</label>
          <textarea class="form-control" type="text" id="add-content" v-model="post.address" disabled="" readonly=""></textarea>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="add-content">Latitud</label>
          <input class="form-control" type="text" id="add-content" v-model="post.latitude" readonly="" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="add-content">Longitud</label>
          <input class="form-control" type="text" id="add-content" v-model="post.longitude" readonly="" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="add-content">Descripcion</label>
          <textarea class="form-control" type="text" id="add-content" v-model="post.description"></textarea>
        </div>
      </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="add-content">Mapa</label>
            <iframe marginheight="0" marginwidth="0" v-bind:src="'//www.openstreetmap.org/export/embed.html?marker=' + post.latitude + ',' + post.longitude + '&bbox=' + post.longitude + ',' + post.latitude" 
            scrolling="no" frameborder="0" height="500" width="700"> 
            </iframe>
          </div>
        </div>
    </div>
      
      <button type="submit" class="btn btn-primary">Guardar</button>
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
