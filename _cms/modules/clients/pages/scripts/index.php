
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
     console.log('no se cargo la lista');
     location.hash = '#';
     location.reload();
   }
};
var List = Vue.extend({
  template: '#post-list',
  data: function () {
    return {
        posts: posts,
        searchKey: ''
    };
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
          'departments_citys',
          'contacts_clients',
          'inspectors_clients',
          'contracts_clients',
        ],
      }
    }).then(function (response) {
      	posts = self.posts = response.data.records;
		// console.log(JSON.stringify(posts));
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
        post: findpost(this.$route.params.post_id),
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
        client_type: 0,
        identification_type: 0,
        identification_number: '',
        social_reason: '',
        tradename: '',
        society_type: 0,
        department_city: 0,
        city: 0,
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

var AddContact = Vue.extend({
  template: '#add-contact',
  data: function () {
    return {
      client_id: 0,
      clientTypesList: [],
      clientData: {
        client: 0,
        first_name: '',
        mail: '',
      }
    }
  },
  methods: {
    createContact: function() {
      var self = this;
      var post = self.clientData;
      
      console.log(post);
      api.post('/contacts_clients',post).then(function (response) {
        self.clientData.id = response.data;
        var Temp = findpost(post.client)
        Temp.contacts_clients.push(post);
      }).catch(function (error) {
        console.log(error);
        console.log(JSON.stringify(error));
      });
      
      router.push('/post/' + post.client  + '/edit');
      
    },
  },
  created: function(){
    var self = this;
    self.client_id = self.$route.params.post_id;
    self.clientData.client = self.client_id;
    
    if(self.clientData.client > 0){
    }
    else{
      router.push('/');
    }
  },
});

var contactDelete = Vue.extend({
  template: '#contact-delete',
  data: function () {
    return {
      contact_id: this.$route.params.contact_id,
      client_id: this.$route.params.post_id,
    };
  },
  methods: {
    deletecontact: function () {
      var clientId = this.client_id;
      var contactId = this.contact_id;
      api.delete('/contacts_clients/' + contactId).then(function (response) {
        console.log(response.data);
        router.push('/');
        location.reload();

      }).catch(function (error) {
        console.log(error);
      });
      router.push('/post/' + clientId  + '/edit');
    }
  }
});

var contactEdit = Vue.extend({
  template: '#contact-edit',
  data: function () {
    return {
        client_id: 0,
        contact_id: 0,
        contactData: {
          description: '',
          client: 0,
          first_name: '',
          mail: '',
        }
    };
  },
  methods: {
    updatecontact: function () {
      var self = this;
      
      api.put('/contacts_clients/' + self.contact_id, self.contactData).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/post/' + self.client_id  + '/edit');
      //location.reload();
    }
  },
  created: function(){
    var self = this;
    self.contactData.client = self.client_id = self.$route.params.post_id;
    self.contactData.id = self.contact_id = self.$route.params.contact_id;
    var Temp3 = findpost(self.client_id);
    if(Temp3.contacts_clients.length > 0)
     {
      for (var key = 0; key < Temp3.contacts_clients.length; key++) {
        if (Temp3.contacts_clients[key].id == self.contact_id) {
          self.contactData = Temp3.contacts_clients[key];
        }
      }
     }
    else
    {
      console.log('Error retornar');
    }
    
  },
});

var Addinspector = Vue.extend({
  template: '#add-inspector',
  data: function () {
    return {
      client_id: 0,
      clientTypesList: [],
      inspectorData: {
        client: 0,
        first_name: '',
        mail: '',
      }
    }
  },
  methods: {
    createinspector: function() {
      var self = this;
      var post = self.inspectorData;
      
      console.log(post);
      api.post('/inspectors_clients',post).then(function (response) {
        self.inspectorData.id = response.data;
        var Temp = findpost(post.client)
        Temp.inspectors_clients.push(post);
      }).catch(function (error) {
        console.log(error);
        console.log(JSON.stringify(error));
      });
      
      router.push('/post/' + post.client  + '/edit');
      
    },
  },
  created: function(){
    var self = this;
    self.client_id = self.$route.params.post_id;
    self.inspectorData.client = self.client_id;
    
    if(self.inspectorData.client > 0){
    }
    else{
      router.push('/');
    }
  },
});

var inspectorDelete = Vue.extend({
  template: '#inspector-delete',
  data: function () {
    return {
      inspector_id: this.$route.params.inspector_id,
      client_id: this.$route.params.post_id,
    };
  },
  methods: {
    deleteinspector: function () {
      var clientId = this.client_id;
      var inspectorId = this.inspector_id;
      api.delete('/inspectors_clients/' + inspectorId).then(function (response) {
        console.log(response.data);
        router.push('/');
        location.reload();

      }).catch(function (error) {
        console.log(error);
      });
    }
  }
});

var inspectorEdit = Vue.extend({
  template: '#inspector-edit',
  data: function () {
    return {
        client_id: 0,
        inspector_id: 0,
        inspectorData: {
          description: '',
          client: 0,
          first_name: '',
          mail: '',
        }
    };
  },
  methods: {
    updateinspector: function () {
      var self = this;
      
      api.put('/inspectors_clients/' + self.inspector_id, self.inspectorData).then(function (response) {
        console.log(response.data);
        router.push('/post/' + self.client_id  + '/edit');
      }).catch(function (error) {
        console.log(error);
      });
      //location.reload();
    }
  },
  created: function(){
    var self = this;
    self.inspectorData.client = self.client_id = self.$route.params.post_id;
    self.inspectorData.id = self.inspector_id = self.$route.params.inspector_id;
    var Temp3 = findpost(self.client_id);
    if(Temp3.inspectors_clients.length > 0)
     {
      for (var key = 0; key < Temp3.inspectors_clients.length; key++) {
        if (Temp3.inspectors_clients[key].id == self.inspector_id) {
          self.inspectorData = Temp3.inspectors_clients[key];
        }
      }
     }
    else
    {
      console.log('Error retornar');
    }
    
  },
});

var Addcontract = Vue.extend({
  template: '#add-contract',
  data: function () {
    return {
      client_id: 0,
      clientTypesList: [],
      contractData: {
        client: 0,
        name: '',
        consecutive: '',
      }
    }
  },
  methods: {
    createcontract: function() {
      var self = this;
      var post = self.contractData;
      
      console.log(post);
      api.post('/contracts_clients',post).then(function (response) {
        self.contractData.id = response.data;
        var Temp = findpost(post.client)
        Temp.contracts_clients.push(post);
      }).catch(function (error) {
        console.log(error);
        console.log(JSON.stringify(error));
      });
      
      router.push('/post/' + post.client  + '/edit');
      
    },
  },
  created: function(){
    var self = this;
    self.client_id = self.$route.params.post_id;
    self.contractData.client = self.client_id;
    
    if(self.contractData.client > 0){
    }
    else{
      router.push('/');
    }
  },
});

var contractDelete = Vue.extend({
  template: '#contract-delete',
  data: function () {
    return {
      contract_id: this.$route.params.contract_id,
      client_id: this.$route.params.post_id,
    };
  },
  methods: {
    deletecontract: function () {
      var clientId = this.client_id;
      var contractId = this.contract_id;
      api.delete('/contracts_clients/' + contractId).then(function (response) {
        console.log(response.data);
        router.push('/');
        location.reload();

      }).catch(function (error) {
        console.log(error);
      });
    }
  }
});

var contractEdit = Vue.extend({
  template: '#contract-edit',
  data: function () {
    return {
        client_id: 0,
        contract_id: 0,
        contractData: {
          description: '',
          client: 0,
          first_name: '',
          mail: '',
        }
    };
  },
  methods: {
    updatecontract: function () {
      var self = this;
      
      api.put('/contracts_clients/' + self.contract_id, self.contractData).then(function (response) {
        console.log(response.data);
        router.push('/post/' + self.client_id  + '/edit');
      }).catch(function (error) {
        console.log(error);
      });
      //location.reload();
    }
  },
  created: function(){
    var self = this;
    self.contractData.client = self.client_id = self.$route.params.post_id;
    self.contractData.id = self.contract_id = self.$route.params.contract_id;
    var Temp3 = findpost(self.client_id);
    if(Temp3.contracts_clients.length > 0)
     {
      for (var key = 0; key < Temp3.contracts_clients.length; key++) {
        if (Temp3.contracts_clients[key].id == self.contract_id) {
          self.contractData = Temp3.contracts_clients[key];
        }
      }
     }
    else
    {
      console.log('Error retornar');
    }
    
  },
});

var router = new VueRouter({routes:[
  { path: '/', component: List},
  { path: '/post/:post_id', component: post, name: 'post'},
  { path: '/add-post', component: Addpost},
  { path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
  { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'},
  { path: '/add-contact', component: AddContact, name: 'contact-add' },
  { path: '/post/:post_id/contact/:contact_id/delete', component: contactDelete, name: 'contact-delete'},
  { path: '/post/:post_id/contact/:contact_id/edit', component: contactEdit, name: 'contact-edit'},
  { path: '/post/:post_id/inspector/:inspector_id/delete', component: inspectorDelete, name: 'inspector-delete'},
  { path: '/post/:post_id/inspector/:inspector_id/edit', component: inspectorEdit, name: 'inspector-edit'},
  { path: '/add-contact/inspector/add', component: Addinspector, name: 'inspector-add' },
  { path: '/post/:post_id/contract/:contract_id/delete', component: contractDelete, name: 'contract-delete'},
  { path: '/post/:post_id/contract/:contract_id/edit', component: contractEdit, name: 'contract-edit'},
  { path: '/add-contact/contract/add', component: Addcontract, name: 'contract-add' },
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
