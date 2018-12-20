
<script>
var posts = [];
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
    return {posts: posts, searchKey: ''};
  },
  created: function () {
    var self = this;
    
    api.get('/crews?join=persons,employee_charges&join=crew_employee&join=crew_employee,employee_charges', {
      params: {
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
    return {
      post: findpost(this.$route.params.post_id),
      employeeList: []
    };
  },
  created: function(){
    var self = this;
    
    api.get('/persons', {
      params: {
      }
    }).then(function (response) {
      self.employeeList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  }
});

var postEdit = Vue.extend({
  template: '#post-edit',
  data: function () {
    return {
      post: findpost(this.$route.params.post_id),
      employeeList: []
    };
  },
  methods: {
    updatepost: function () {
      var post = this.post;
      var postTemp = post;
      postTemp.supervisor = post.supervisor.id;
      postTemp.supervisor_e = post.supervisor_e.id;
      
      api.put('/crews/'+post.id, postTemp).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
      location.reload();
    }
  },
  created: function(){
    var self = this;
    
    api.get('/persons', {
      params: {
      }
    }).then(function (response) {
      self.employeeList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  }
});
  
var postDelete = Vue.extend({
  template: '#post-delete',
  data: function () {
    return {post: findpost(this.$route.params.post_id)};
  },
  methods: {
    deletepost: function () {
      var post = this.post;
      api.delete('/crews/'+post.id).then(function (response) {
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
      employeeList: [],
      post: {
        code: '',
        supervisor: 0,
        supervisor_e: 0
      }
    }
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/crews',post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
  },
  created: function(){
    var self = this;
    
    api.get('/persons', {
      params: {
      }
    }).then(function (response) {
      self.employeeList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  }
});

var crewDelete = Vue.extend({
  template: '#crew-delete',
  data: function () {
    return {
      post: findpost(this.$route.params.post_id),
      post_id: this.$route.params.post_id,
      crow_id: this.$route.params.crow_id,
    };
  },
  methods: {
    deletepost: function () {
      var self = this;
      
      var contactId = self.$route.params.crew_id;
      console.log('Eliminando Contacto: ' + contactId);
      api.delete('/crew_employee/' + contactId).then(function (response) {
        
        var vehicleTemp = findpost(self.post_id);
      }).catch(function (error) {
        console.log(error);
        console.log(error.response);
        console.log(JSON.stringify(error.response));
      });
      
      router.push('/');
      location.reload();
    }
  }
});


var Addcrew = Vue.extend({
  template: '#add-crew',
  data: function () {
    return {
        crewList: [],
        employeeList: [],
        employeeChargesList: [],
        post_id: this.$route.params.post_id,
        post: {
            crew: this.$route.params.post_id,
            employee: 0,
            charge: 0,
        }
    }
  },
  methods: {
    createpost: function() {
      var self = this;
      var post = this.post;
      api.post('/crew_employee', post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      //router.push('/post/' + self.$route.params.post_id + '/edit');
      router.push('/');
      location.reload();
    }
  },
  created: function(){
    var self = this;
    
    api.get('/crews', {
      params: {
      }
    }).then(function (response) {
      self.crewList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/persons', {
      params: {
      }
    }).then(function (response) {
      self.employeeList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/employee_charges', {
      params: {
      }
    }).then(function (response) {
      self.employeeChargesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    
  }
});

var router = new VueRouter({routes:[
  { path: '/', component: List},
  { path: '/post/:post_id', component: post, name: 'post'},
  { path: '/add-post', component: Addpost},
  { path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
  { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'},
  { path: '/post/:post_id/delete-crew/:crew_id', component: crewDelete, name: 'crew-delete'},
  { path: '/post/:post_id/add-crew', component: Addcrew, name: 'crew-add'},
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
