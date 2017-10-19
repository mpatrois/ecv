var UsersComponent = {
  template:'#template-users',
  data: function(){
    	return {
    		users: []
    	}
  },
  mounted : function(){
  	vm = this;
  	this.$http.get('/users').then(function(data){
  		vm.users = data.body;
  	})
  }
};

var UserComponent = {
  template:'#template-user',
  data: function(){
    	return {
    		user: {},
        errors:{}
    	}
  },
  mounted : function(){
  	vm = this;
    this.$http.get('/users/'+vm.$route.params.id).then(function(data){
      console.log(data.body);
  		vm.user = data.body;
  	})
  },
  methods:{
    updateUser(user){
      vm.errors = {};
      this.$http.post('/users/'+vm.user.id,user).then(function(data){
        // vm.user = data.body;
      },function(data){
        vm.errors = data.body;
      });
    }
  }
};

const routes = [
  { path: '/users', name :'users' , component: UsersComponent },
  { path: '/user/:id', name :'user' , component: UserComponent },
  {path: '*', redirect: '/users'}
]

const router = new VueRouter({
  routes
})

const app = new Vue({
  router
}).$mount('#app')
