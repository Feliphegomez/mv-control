
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
    return {
        posts: posts,
        searchKey: '',
    };
  },
  created: function () {
    var self = this;
    api.get('/vehicles', {
        params: {
            join: [
                'categorys_vehicles',
                'fuel_types',
                'status_vehicles',
                'persons',
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
    return {
        post: findpost(this.$route.params.post_id),
        categoryVehiclesList: [],
        fuelsVehiclesList: [],
        statusVehiclesList: [],
    };
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.categoryVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fuel_types', {
      params: {
      }
    }).then(function (response) {
      self.fuelsVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.statusVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  },
});
var postEdit = Vue.extend({
  template: '#post-edit',
  data: function () {
    return {
        post: findpost(this.$route.params.post_id),
        categoryVehiclesList: [],
        fuelsVehiclesList: [],
        statusVehiclesList: [],
    };
  },
  methods: {
    updatepost: function () {
      var post = this.post;
      var postTemp = this.post;
      postTemp.category = post.category.id;
      postTemp.fuel = post.fuel.id;
      postTemp.status = post.status.id;
      
      
      api.put('/vehicles/'+post.id, postTemp).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.categoryVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fuel_types', {
      params: {
      }
    }).then(function (response) {
      self.fuelsVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.statusVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
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
      api.delete('/vehicles/'+post.id).then(function (response) {
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
        categoryVehiclesList: [],
        fuelsVehiclesList: [],
        statusVehiclesList: [],
        post: {
            category: 0,
            status: 0,
            fuel: 0
        }
    }
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/vehicles',post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.categoryVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fuel_types', {
      params: {
      }
    }).then(function (response) {
      self.fuelsVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_vehicles', {
      params: {
      }
    }).then(function (response) {
      self.statusVehiclesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  },
});

var Adddriver = Vue.extend({
  template: '#add-driver',
  data: function () {
    return {
        vehiclesList: [],
        employeeList: [],
        post: {
            vehicle: this.$route.params.post_id,
            employee: 0,
        }
    }
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/drivers_vehicles',post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
  },
  created: function(){
    var self = this;
    
    api.get('/vehicles', {
      params: {
      }
    }).then(function (response) {
      self.vehiclesList = response.data.records;
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
  },
});

var router = new VueRouter({routes:[
  { path: '/', component: List},
  { path: '/post/:post_id', component: post, name: 'post'},
  { path: '/add-post', component: Addpost},
  { path: '/post/:post_id/add-driver', component: Adddriver, name: 'driver-add'},
  { path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
  { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'}
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
