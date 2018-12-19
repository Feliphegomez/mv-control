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
     // http://mv-operation.dataservix.com/forms/services
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
        categoriesServicesList: [],
    };
  },
  created: function () {
    var self = this;
    api.get('/services', {
      params: {
        join:[
          'payments_types',
          'categorys_services',
        ],
      }
    }).then(function (response) {
      posts = self.posts = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/categorys_services', {
      params: {
      }
    }).then(function (response) {
      self.categoriesServicesList = response.data.records;
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
            paymentsTypesList: [],
            post: findpost(this.$route.params.post_id),
            categoriesServicesList: []
        };
    },
    methods: {
        updatepost: function () {
            var post = this.post;
            var newPost = post;
            newPost.payment_type = post.payment_type.id;
            newPost.category = post.category.id;
            console.log(JSON.stringify(newPost));
            /**/
            api.put('/services/'+post.id,newPost).then(function (response) {
                console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });
            router.push('/');
        },
    },
    created: function(){
        var self = this;
        api.get('/payments_types', {
          params: {
          }
        }).then(function (response) {
          self.paymentsTypesList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        api.get('/categorys_services', {
          params: {
          }
        }).then(function (response) {
          self.categoriesServicesList = response.data.records;
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
      api.delete('/services/'+post.id).then(function (response) {
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
      paymentsTypesList: [],
      categoriesServicesList: [],
      post: {
        name: '',
        payment_type: 0,
        description: '',
        price: '',
        category: 0
      }}
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/services',post).then(function (response) {
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
      
      api.get('/citys', {
        params: {
          filter: 'department,eq,' + idDepartment
        }
      }).then(function (response) {
        self.citysList = response.data.records;
      }).catch(function (error) {
        console.log(error);
      });
    }
  },
  created: function(){
    var self = this;
    api.get('/payments_types', {
      params: {
      }
    }).then(function (response) {
      self.paymentsTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    api.get('/categorys_services', {
      params: {
      }
    }).then(function (response) {
      self.categoriesServicesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
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
