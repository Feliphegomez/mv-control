<div class="container">
  <header class="page-header">
    <div class="branding">
      <img src="https://vuejs.org/images/logo.png" alt="Logo" title="Home page" class="logo"/>
      <h1>Tipos de Sociedades</h1>
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
        <th>Descripcion</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-if="posts===null">
        <td colspan="4">Loading...</td>
      </tr>
      <tr v-else v-for="post in filteredposts">
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.id }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.name }}</router-link></td>
        <td><router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">{{ post.description }}</router-link></td>
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
      <div class="form-group">
        <label for="add-content">Nombre</label>
        <input class="form-control" type="text" id="add-content" v-model="post.name" />
      </div>
      <button type="submit" class="btn btn-primary">Crear</button>
      <router-link class="btn btn-primary" v-bind:to="'/'">Cancelar</router-link>
    </form>
  </div>
</template>

<template id="post">
  <div>
    <b>Nombre: </b>
    <div>{{ post.id }}</div>
    <div>{{ post.name }}</div>
    <div>{{ post.description }}</div>
    <br/>
    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
    <router-link v-bind:to="'/'">Volver a la lista de mensajes</router-link>
  </div>
</template>

<template id="post-edit">
  <div>
    <h2>Modificar post</h2>
    <form v-on:submit="updatepost">
      <div class="form-group">
        <label for="edit-content">Content</label>
        <input class="form-control" id="edit-content" v-model="post.name" />
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
