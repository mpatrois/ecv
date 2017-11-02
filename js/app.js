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
        fullName : '',
        errors:{},

    	}
  },
  mounted : function(){
  	vm = this;
    this.$http.get('/users/'+vm.$route.params.id).then(function(data){
      vm.user = data.body;
      vm.fullName = vm.user.lastname + ' ' + vm.user.firstname;
  	})
  },
  methods:{
    updateUser(user){
      vm.errors = {};
      this.$http.post('/users/'+vm.user.id,user).then(function(data){
        // vm.user = data.body;
        vm.fullName = vm.user.lastname + ' ' + vm.user.firstname;
      },function(data){
        vm.errors = data.body;
      });
    }
  }
};


Vue.directive('errors', {
  update: function (el, binding, vnode) {
    el.innerHTML = "";
    console.log(binding);
    if(binding.value){
      for (var i = 0; i < binding.value.length; i++) {
        el.innerHTML += "<div>" + binding.value[i] +"</div>";
      }
    };
  }
})

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
