var UsersComponent = {
  template:'#template-users',
  data: function(){
    	return {
    		users: []
    	}
  },
  mounted : function(){
  	vm = this;
  	this.$http.get('users.php').then(function(data){
  		vm.users = data.body;
  	})
  }
};

var UserComponent = {
  template:'#template-user',
  data: function(){
    	return {
    		user: {}
    	}
  },
  mounted : function(){
  	vm = this;
  	this.$http.get('users.php').then(function(data){
  		vm.user = data.body;
  	})
  }
};

const routes = [
  { path: '/users', name :'users' , component: UsersComponent },
  { path: '/user/:id', name :'user' , component: UserComponent },
]

const router = new VueRouter({
  routes
})

const app = new Vue({
  router
}).$mount('#app')
