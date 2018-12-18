
<script>
var posts = null;
var api = axios.create({
  baseURL: '/api/v0/api.php/records'
});
function findpost (postId) {
  return posts[findpostKey(postId)];
};
function findpostKey (postId) {
  for (var key = 0; key < posts.length; key++) {
    if (posts[key].id == postId) {
      return key;
    }
  }
};
var List = Vue.extend({
  template: '#post-list',
  data: function () {
    return {posts: posts, searchKey: ''};
  },
  created: function () {
    var self = this;
    api.get('/eps').then(function (response) {
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
    return {post: findpost(this.$route.params.post_id)};
  },
  methods: {
    updatepost: function () {
      var post = this.post;
      api.put('/eps/'+post.id,post).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
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
      api.delete('/eps/'+post.id).then(function (response) {
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
    return {post: {content: '', user_id: 1, category_id: 1}}
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/eps',post).then(function (response) {
        post.id = response.data;
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/');
    }
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
