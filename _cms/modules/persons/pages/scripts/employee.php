
<script>
var posts = [];
var api = axios.create({
  baseURL: '/api/v0/api.php/records'
});

/*
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
/*/

var List = Vue.extend({
  template: '#post-list',
  data: function () {
    return {
        posts: [], 
        searchKey: ''
    };
  },
  created: function () {
    var self = this;
    api.get('/persons', {
        params: {
            join: [
                'status_employee',
                'identification_types',
                'eps',
                'arl',
                'blood_types',
                'blood_rhs',
                'pension_funds',
                'compensation_funds',
                'severance_funds',
                'contacts_employee',
            ]
        }
    }).then(function (response) {
      self.posts = response.data.records;
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
            post_id: this.$route.params.post_id,
            post: {
                id: this.$route.params.post_id,
                identification_type: {
                    id: this.$route.params.post_id,
                },
                blood_type: {
                    id: 0,
                },
                blood_rh: {
                    id: 0,
                },
                status: {
                    id: 0,
                },
                eps: {
                    id: 0,
                },
                arl: {
                    id: 0,
                },
                pension_fund: {
                    id: 0,
                },
                compensation_fund: {
                    id: 0,
                },
                severance_fund: {
                    id: 0,
                },
                reason_resignation: {
                    id: 0,
                },
            },
            identificationTypesList: [],
            bloodTypesList: [],
            bloodRHsList: [],
            epsList: [],
            arlList: [],
            statusEmployeeList: [],
            pensionFundsList: [],
            compensationFundsList: [],
            severanceFundsList: [],
            reasonResignationList: [],
            image_preview: {
                name: '',
                size: 0,
                src: '',
                type: '',
            }
        };
    },
	mounted: function(){
        var self = this;
        api.get('/persons', {
            params: {
                join: [
                    'status_employee',
                    'identification_types',
                    'eps',
                    'arl',
                    'blood_types',
                    'blood_rhs',
                    'pension_funds',
                    'compensation_funds',
                    'severance_funds',
                    'contacts_employee',
                    'reasons_resignation',
                ],
                filter: [
					'id,eq,' + self.$route.params.post_id
				],
            }
        }).then(function (response) {
          self.post = response.data.records[0];
          console.log(self.post);
        }).catch(function (error) {
          console.log(error);
        });
    }
});

var postEdit = Vue.extend({
    template: '#post-edit',
    data: function () {
        return {
            post_id: this.$route.params.post_id,
            //post: findpost(this.$route.params.post_id),
            post: {
                id: this.$route.params.post_id,
                identification_type: {
                    id: this.$route.params.post_id,
                },
                blood_type: {
                    id: 0,
                },
                blood_rh: {
                    id: 0,
                },
                status: {
                    id: 0,
                },
                eps: {
                    id: 0,
                },
                arl: {
                    id: 0,
                },
                pension_fund: {
                    id: 0,
                },
                compensation_fund: {
                    id: 0,
                },
                severance_fund: {
                    id: 0,
                },
                reason_resignation: {
                    id: 0,
                },
            },
            identificationTypesList: [],
            bloodTypesList: [],
            bloodRHsList: [],
            epsList: [],
            arlList: [],
            statusEmployeeList: [],
            pensionFundsList: [],
            compensationFundsList: [],
            severanceFundsList: [],
            reasonResignationList: [],
            image_preview: {
                name: '',
                size: 0,
                src: '',
                type: '',
            }
        };
    },
    methods: {
        updatepost: function () {
          var post = this.post;
          var postTemp = post;
          postTemp.identification_type = post.identification_type.id;
          postTemp.blood_type = post.blood_type.id;
          postTemp.blood_rh = post.blood_rh.id;
          postTemp.status = post.status.id;
          postTemp.eps = post.eps.id;
          postTemp.arl = post.arl.id;
          postTemp.pension_fund = post.pension_fund.id;
          postTemp.compensation_fund = post.compensation_fund.id;
          postTemp.severance_fund = post.severance_fund.id;
          
          api.put('/persons/' + this.$route.params.post_id, postTemp).then(function (response) {
            console.log(response.data);
            location.reload();
          }).catch(function (error) {
            console.log(error);
          });
        },
        changeImage: function(e){
			var self = this;
			var image = e;
			var file = image.target.files[0];
			var reader = new FileReader();
			// Set preview image into the popover data-content

			reader.onload = function (e) {
				self.image_preview.name = file.name;
				self.image_preview.size = file.size;
				self.image_preview.src = e.target.result;
				self.image_preview.type = file.type;
				//img.attr('src', e.target.result);
				///$(".image-preview-filename").val(file.name);
				$(".image-preview-input-title").text("Cambiando");

				//$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");


				api.post('/images', self.image_preview).then(function (response) {
					var imageId = response.data;
					self.post.avatar = imageId;
                    self.updatepost();
				}).catch(function (error) {
					console.log(error.response);
				});

			}        
			reader.readAsDataURL(file);
		}
    },
    created: function(){
        var self = this;
        
        api.get('/identification_types', {
          params: {
          }
        }).then(function (response) {
          self.identificationTypesList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/blood_types', {
          params: {
          }
        }).then(function (response) {
          self.bloodTypesList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/blood_rhs', {
          params: {
          }
        }).then(function (response) {
          self.bloodRHsList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/eps', {
          params: {
          }
        }).then(function (response) {
          self.epsList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/arl', {
          params: {
          }
        }).then(function (response) {
          self.arlList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/status_employee', {
          params: {
          }
        }).then(function (response) {
          self.statusEmployeeList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/pension_funds', {
          params: {
          }
        }).then(function (response) {
          self.pensionFundsList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/compensation_funds', {
          params: {
          }
        }).then(function (response) {
          self.compensationFundsList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/severance_funds', {
          params: {
          }
        }).then(function (response) {
          self.severanceFundsList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
        api.get('/reasons_resignation', {
          params: {
          }
        }).then(function (response) {
          self.reasonResignationList = response.data.records;
        }).catch(function (error) {
          console.log(error);
        });
        
    },
	mounted: function(){
        var self = this;
        api.get('/persons', {
            params: {
                join: [
                    'status_employee',
                    'identification_types',
                    'eps',
                    'arl',
                    'blood_types',
                    'blood_rhs',
                    'pension_funds',
                    'compensation_funds',
                    'severance_funds',
                    'contacts_employee',
                    'reasons_resignation',
                ],
                filter: [
					'id,eq,' + self.$route.params.post_id
				],
            }
        }).then(function (response) {
          self.post = response.data.records[0];
          console.log(self.post);
        }).catch(function (error) {
          console.log(error);
        });
    }
});
var postDelete = Vue.extend({
    template: '#post-delete',
    data: function () {
        return {
            post_id: this.$route.params.post_id,
            post: {
                id: this.$route.params.post_id,
                identification_type: {
                    id: this.$route.params.post_id,
                },
                blood_type: {
                    id: 0,
                },
                blood_rh: {
                    id: 0,
                },
                status: {
                    id: 0,
                },
                eps: {
                    id: 0,
                },
                arl: {
                    id: 0,
                },
                pension_fund: {
                    id: 0,
                },
                compensation_fund: {
                    id: 0,
                },
                severance_fund: {
                    id: 0,
                },
                reason_resignation: {
                    id: 0,
                },
            },
            identificationTypesList: [],
            bloodTypesList: [],
            bloodRHsList: [],
            epsList: [],
            arlList: [],
            statusEmployeeList: [],
            pensionFundsList: [],
            compensationFundsList: [],
            severanceFundsList: [],
            reasonResignationList: [],
            image_preview: {
                name: '',
                size: 0,
                src: '',
                type: '',
            }
        };
    },
    methods: {
        deletepost: function () {
          var post = this.post;
          api.delete('/persons/'+post.id).then(function (response) {
            console.log(response.data);
          }).catch(function (error) {
            console.log(error);
          });
          router.push('/');
        }
    },
    mounted: function(){
        var self = this;
        api.get('/persons', {
            params: {
                join: [
                    'status_employee',
                    'identification_types',
                    'eps',
                    'arl',
                    'blood_types',
                    'blood_rhs',
                    'pension_funds',
                    'compensation_funds',
                    'severance_funds',
                    'contacts_employee',
                    'reasons_resignation',
                ],
                filter: [
					'id,eq,' + self.$route.params.post_id
				],
            }
        }).then(function (response) {
          self.post = response.data.records[0];
          console.log(self.post);
        }).catch(function (error) {
          console.log(error);
        });
    }
});
var Addpost = Vue.extend({
  template: '#add-post',
  data: function () {
    return {
      post: {
          first_name: '',
          second_name: '',
          surnname: '',
          second_name: '',
          identification_type: 0,
          identification_number: '',
          identification_date_expedition: '',
          birthdate: '',
          blood_type: 0,
          blood_rh: 0,
          mail: 'empleado@sincorreo.com',
          number_phone: '',
          number_mobile: '',
          company_date_entry: '',
          company_date_out: '',
          company_mail: '',
          company_number_phone: '',
          company_number_mobile: '',
          avatar: 0,
          status: 0,
          eps: 0,
          arl: 0,
          pension_fund: 0,
          compensation_fund: 0,
          severance_fund: 0,
          observations: '',
      },
      identificationTypesList: [],
      bloodTypesList: [],
      bloodRHsList: [],
      epsList: [],
      arlList: [],
      statusEmployeeList: [],
      pensionFundsList: [],
      compensationFundsList: [],
      severanceFundsList: [],
    }
  },
  methods: {
    createpost: function() {
      var post = this.post;
      api.post('/persons', post).then(function (response) {
        post.id = response.data;
        router.push('/');
      }).catch(function (error) {
          console.log(error);
          console.log(error.response);
          console.log(JSON.stringify(error));
          //console.log(JSON.stringify(error.response));
          //console.log(JSON.stringify(post));
      });
    }
  },
  created: function(){
    var self = this;
    
    api.get('/identification_types', {
      params: {
      }
    }).then(function (response) {
      self.identificationTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/blood_types', {
      params: {
      }
    }).then(function (response) {
      self.bloodTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/blood_rhs', {
      params: {
      }
    }).then(function (response) {
      self.bloodRHsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/eps', {
      params: {
      }
    }).then(function (response) {
      self.epsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/arl', {
      params: {
      }
    }).then(function (response) {
      self.arlList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/status_employee', {
      params: {
      }
    }).then(function (response) {
      self.statusEmployeeList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/pension_funds', {
      params: {
      }
    }).then(function (response) {
      self.pensionFundsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/compensation_funds', {
      params: {
      }
    }).then(function (response) {
      self.compensationFundsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    
    api.get('/severance_funds', {
      params: {
      }
    }).then(function (response) {
      self.severanceFundsList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  }
});
  
  
var AddContact = Vue.extend({
  template: '#add-contact',
  data: function () {
    return {
      employee_id: 0,
      contactData: {
        employee: 0,
        first_name: '',
        mail: '',
      }
    }
  },
  methods: {
    createContact: function() {
      var self = this;
      var post = self.contactData;
      
      console.log(post);
      api.post('/contacts_employee',post).then(function (response) {
        self.contactData.id = response.data;
        var Temp = findpost(post.employee)
        Temp.contacts_employee.push(post);
      }).catch(function (error) {
        console.log(error);
        console.log(JSON.stringify(error));
      });
      
      router.push('/post/' + post.employee  + '/edit');
      
    },
  },
  created: function(){
    var self = this;
    self.employee_id = self.$route.params.post_id;
    self.contactData.employee = self.employee_id;
    
    if(self.contactData.employee > 0){
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
      employee_id: this.$route.params.post_id,
    };
  },
  methods: {
    deletecontact: function () {
      var employeeId = this.employee_id;
      var contactId = this.contact_id;
      api.delete('/contacts_employee/' + contactId).then(function (response) {
        console.log(response.data);
        router.push('/');
        location.reload();

      }).catch(function (error) {
        console.log(error);
      });
      router.push('/post/' + employeeId  + '/edit');
    }
  }
});

var contactEdit = Vue.extend({
  template: '#contact-edit',
  data: function () {
    return {
        employee_id: 0,
        contact_id: 0,
        contactData: {
          description: '',
          employee: 0,
          first_name: '',
          mail: '',
        }
    };
  },
  methods: {
    updatecontact: function () {
      var self = this;
      
      api.put('/contacts_employee/' + self.contact_id, self.contactData).then(function (response) {
        console.log(response.data);
      }).catch(function (error) {
        console.log(error);
      });
      router.push('/post/' + self.employee_id  + '/edit');
      //location.reload();
    }
  },
  created: function(){
    var self = this;
    self.contactData.employee = self.employee_id = self.$route.params.post_id;
    self.contactData.id = self.contact_id = self.$route.params.contact_id;
    var Temp3 = findpost(self.employee_id);
    if(Temp3.contacts_employee.length > 0)
     {
      for (var key = 0; key < Temp3.contacts_employee.length; key++) {
        if (Temp3.contacts_employee[key].id == self.contact_id) {
          self.contactData = Temp3.contacts_employee[key];
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
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
