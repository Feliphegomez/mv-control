
<script>
$(document).ready(function() {
    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
});




    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");
});
</script>

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
    return {
        identificationTypesList: [],
        servicesList: [],
        identification_type: '',
        identification_number: '',
        client: {
            id: 0,
            identification_number: 0,
            client_type: {
                id: 0,
                name: '',
            },
            society_type: {
                id: 0,
                name: '',
            }
        }
    };
  },
  created: function () {
    var self = this;
    
    
    api.get('/identification_types', {
      params: {
      }
    }).then(function (response) {
      self.identificationTypesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
    api.get('/services', {
      params: {
      }
    }).then(function (response) {
      self.servicesList = response.data.records;
    }).catch(function (error) {
      console.log(error);
    });
  },
    methods: {
        searchClient: function(){
            var self = this;
            
            if(self.identification_number != '' && self.identification_type)
            {
                
                api.get('/clients', {
                  params: {
                    filter:[
                        'identification_type,eq,' + self.identification_type,
                        'identification_number,eq,' + self.identification_number,
                    ],
                    join:[
                      'client_types',
                      'society_types',
                      'identification_types',
                      'citys',
                      'departments_citys'
                    ],
                  }
                }).then(function (response) {
                    if(response.data.records.length == 0){
                        alert('Cliente no encontrado');
                    }
                    else
                    {
                        self.client = response.data.records[0];
                    }
                }).catch(function (error) {
                  console.log(error);
                });
            }
        }
    }
});
var router = new VueRouter({routes:[
  { path: '/', component: List},
]});
app = new Vue({
  router:router
}).$mount('#app')
</script>
