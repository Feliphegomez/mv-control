
<script>
var posts = [];

var api = axios.create({
  baseURL: '/api/v0/api.php/records'
});
  
var mapSearch = axios.create({
  baseURL: 'http://nominatim.openstreetmap.org'
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
    api.get('/lots').then(function (response) {
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
      addressRepair: '',
      categoryLotsList: [],
      resultSearch: [],
      zonesList: [],
      paymentsTypesList: [],
      fortnightsList: [],
      statusRegistrationsList: [],
    };
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_lots', {
      params: {
      }
    }).then(function (response) {
      self.categoryLotsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/zones', {
      params: {
      }
    }).then(function (response) {
      self.zonesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/payments_types', {
      params: {
      }
    }).then(function (response) {
      self.paymentsTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fortnights', {
      params: {
      }
    }).then(function (response) {
      self.fortnightsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_registrations', {
      params: {
      }
    }).then(function (response) {
      self.statusRegistrationsList = response.data.records;
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
      addressRepair: '',
      categoryLotsList: [],
      resultSearch: [],
      zonesList: [],
      paymentsTypesList: [],
      fortnightsList: [],
      statusRegistrationsList: [],
    };
  },
  methods: {
    updatepost: function () {
      var post = this.post;
      var postTemp = post;
      postTemp.category = post.category.id;
      postTemp.zone = post.zone.id;
      postTemp.payment_type = post.payment_type.id;
      postTemp.fortnight = post.fortnight.id;
      postTemp.status_registration = post.status_registration.id;
      
      api.put('/lots/'+post.id,post).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    },
    searchAddressMaps: function(){
      var self = this;
      searchText = self.addressRepair;      
      
      mapSearch.get('/search', {
        params: {
          format: 'json',
          //country: 'colombia',
          q: searchText
        }
      }).then(function (response) {
        self.resultSearch = response.data;
        console.log(self.resultSearch);
        console.log(self.resultSearch.length);
        
        if(self.resultSearch.length > 0)
        {
          self.post.address = self.resultSearch[0].display_name;
          self.post.latitude = self.resultSearch[0].lat;
          self.post.longitude = self.resultSearch[0].lon;
        }
        else
        {
          self.post.address = 'Direccion invalida';
          self.post.latitude = 0;
          self.post.longitude = 0;
        }
      }).catch(function (error) {
        console.log(error);
      });
    }
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_lots', {
      params: {
      }
    }).then(function (response) {
      self.categoryLotsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/zones', {
      params: {
      }
    }).then(function (response) {
      self.zonesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/payments_types', {
      params: {
      }
    }).then(function (response) {
      self.paymentsTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fortnights', {
      params: {
      }
    }).then(function (response) {
      self.fortnightsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_registrations', {
      params: {
      }
    }).then(function (response) {
      self.statusRegistrationsList = response.data.records;
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
      api.delete('/lots/'+post.id).then(function (response) {
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
      addressRepair: '',
      categoryLotsList: [],
      resultSearch: [],
      zonesList: [],
      paymentsTypesList: [],
      fortnightsList: [],
      statusRegistrationsList: [],
      post: {
        code: '',
        name: '',
        category: 0,
        address: '',
        zone: 0,
        payment_type: 0,
        fortnight: 0,
        status_registration: 0,
      }
    }
  },
  methods: {
    createpost: function() {
      var post = this.post;
      console.log(post);
      
      api.post('/lots', post).then(function (response) {
        post.id = response.data;
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    },
    searchAddressMaps: function(){
      var self = this;
      searchText = self.addressRepair;      
      
      mapSearch.get('/search', {
        params: {
          format: 'json',
          //country: 'colombia',
          q: searchText
        }
      }).then(function (response) {
        self.resultSearch = response.data;
        console.log(self.resultSearch);
        console.log(self.resultSearch.length);
        
        if(self.resultSearch.length > 0)
        {
          self.post.address = self.resultSearch[0].display_name;
          self.post.latitude = self.resultSearch[0].lat;
          self.post.longitude = self.resultSearch[0].lon;
        }
        else
        {
          self.post.address = 'Direccion invalida';
          self.post.latitude = 0;
          self.post.longitude = 0;
        }
      }).catch(function (error) {
        console.log(error);
      });
    }
  },
  created: function(){
    var self = this;
    
    api.get('/categorys_lots', {
      params: {
      }
    }).then(function (response) {
      self.categoryLotsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/zones', {
      params: {
      }
    }).then(function (response) {
      self.zonesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/payments_types', {
      params: {
      }
    }).then(function (response) {
      self.paymentsTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/fortnights', {
      params: {
      }
    }).then(function (response) {
      self.fortnightsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_registrations', {
      params: {
      }
    }).then(function (response) {
      self.statusRegistrationsList = response.data.records;
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
  { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'}
]});

app = new Vue({
  router:router
}).$mount('#app')
</script>
