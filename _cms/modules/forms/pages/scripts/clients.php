
<script>
var posts = new Array();
var api = axios.create({
  baseURL: '/api/v0/api.php/records'
});
function findpost (postId) {
  return posts[findpostKey(postId)];
};
function findpostKey (postId) {
  if(posts.length > 0)
   {
    for (var key = 0; key < posts.length; key++) {
      if (posts[key].id == postId) {
        return key;
      }
    }
   }
   else
   {
     // http://mv-operation.dataservix.com/forms/clients
     console.log('no se cargo la lista');
     location.hash = '#';
     location.reload();
   }
};
var List = Vue.extend({
  template: '#post-list',
  data: function () {
    return {posts: posts, searchKey: ''};
  },
  created: function () {
    var self = this;
    api.get('/clients', {
      params: {
        join:[
          'client_types',
          'society_types',
          'identification_types',
          'citys',
          'departments_citys'
        ],
      }
    }).then(function (response) {
      posts = self.posts = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  },
  computed: {
    filteredposts: function () {
      return this.posts.filter(function (post) {
        return this.searchKey=='' || post.name.indexOf(this.searchKey) !== -1;
      },this);
    }
  }
});
var post = Vue.extend({
  template: '#post',
  data: function () {
    return {post: findpost(this.$route.params.post_id)};
  }
});
var postEdit = Vue.extend({
  template: '#post-edit',
  data: function () {
    return {
        clientTypesList: [],
        identificationTypesList: [],
        societyTypesList: [],
        departmentsCitysList: [],
        citysList: [],
        post: findpost(this.$route.params.post_id)
    };
  },
  methods: {
    updatepost: function () {
        var post = this.post;
        var newPost = post;
        newPost.client_type = post.client_type.id;
        newPost.identification_type = post.identification_type.id;
        newPost.society_type = post.society_type.id;
        newPost.city = post.city.id;
        newPost.department_city = post.department_city.id;
        console.log(JSON.stringify(newPost));
      /**/
      api.put('/clients/'+post.id,newPost).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    },
    loadCityDepartment: function(e){
      var self = this;
      var idDepartment = e.target.value;
      //console.log(e.target.value);
      
      /* ---------------- TIPOS DE CIUDADES (LISTA SELECT - OPTIONS - CON FILTRO) - INICIO ---------------- */
      api.get('/citys', {
        params: {
          filter: 'department,eq,' + idDepartment
        }
      }).then(function (response) {
        self.citysList = response.data.records;
      }).catch(function (error) {
        console.log(error);
      });
      /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS - CON FILTRO) - FIN ---------------- */
    }
  },
  created: function(){
    var self = this;
    
    /* ---------------- TIPOS DE CLIENTES (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/client_types', {
      params: {
      }
    }).then(function (response) {
      self.clientTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE CLIENTES (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE IDENTIFICACION (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/identification_types', {
      params: {
      }
    }).then(function (response) {
      self.identificationTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE IDENTIFICACION (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/society_types', {
      params: {
      }
    }).then(function (response) {
      self.societyTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE DEPARTAMENTOS (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/departments_citys', {
      params: {
      }
    }).then(function (response) {
      self.departmentsCitysList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE DEPARTAMENTOS (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE DEPARTAMENTOS (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/citys', {
      params: {
          filter: 'department,eq,' + self.post.department_city.id
      }
    }).then(function (response) {
      self.citysList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE DEPARTAMENTOS (LISTA SELECT - OPTIONS) - FIN ---------------- */
    
    //self.clientTypesList = 
  },
});
var postDelete = Vue.extend({
  template: '#post-delete',
  data: function () {
    return {post: findpost(this.$route.params.post_id)};
  },
  methods: {
    deletepost: function () {
      var post = this.post;
      api.delete('/clients/'+post.id).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
  }
});
var Addpost = Vue.extend({
  template: '#add-post',
  data: function () {
    return {
      clientTypesList: [],
      identificationTypesList: [],
      societyTypesList: [],
      departmentsCitysList: [],
      citysList: [],
      post: {
        content: '',
        user_id: 1,
        category_id: 1
      }}
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/clients',post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    },
    loadCityDepartment: function(e){
      var self = this;
      var idDepartment = e.target.value;
      //console.log(e.target.value);
      
      /* ---------------- TIPOS DE CIUDADES (LISTA SELECT - OPTIONS - CON FILTRO) - INICIO ---------------- */
      api.get('/citys', {
        params: {
          filter: 'department,eq,' + idDepartment
        }
      }).then(function (response) {
        self.citysList = response.data.records;
      }).catch(function (error) {
        console.log(error);
      });
      /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS - CON FILTRO) - FIN ---------------- */
    }
  },
  created: function(){
    var self = this;
    
    /* ---------------- TIPOS DE CLIENTES (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/client_types', {
      params: {
      }
    }).then(function (response) {
      self.clientTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE CLIENTES (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE IDENTIFICACION (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/identification_types', {
      params: {
      }
    }).then(function (response) {
      self.identificationTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE IDENTIFICACION (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/society_types', {
      params: {
      }
    }).then(function (response) {
      self.societyTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - FIN ---------------- */
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - INICIO ---------------- */
    api.get('/departments_citys', {
      params: {
      }
    }).then(function (response) {
      self.departmentsCitysList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    /* ---------------- TIPOS DE SOCIEDADES (LISTA SELECT - OPTIONS) - FIN ---------------- */
    
    //self.clientTypesList = 
  },
});
var router = new VueRouter({routes:[
  { path: '/', component: List},
  { path: '/post/:post_id', component: post, name: 'post'},
  { path: '/add-post', component: Addpost},
  { path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
  { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'}
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
