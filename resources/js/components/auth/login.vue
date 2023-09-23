<template>
	<div>
		<div class="card card-login mx-auto mt-5">
      <div class="card-header">Pharmachy Login</div>
      <div class="card-body ">
        <form @submit.prevent="login">
          <div class="form-group ">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" v-model="form.email"  required="required" autofocus="autofocus">
              
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" v-model="form.password"  required="required">
            
              <label for="inputPassword">Password</label>
            </div>
          </div>
         
          <button type="submit" class="btn btn-primary ">Login</button>
        </form>
        
      </div>
    </div>
	</div>
</template>

<script>

export default{

  data(){
    return{
      form:{
        email:null,
        password:null
      },
    
    }
  },
  methods:{
    login(){
      axios.post('/api/auth/login',this.form)
      .then(response=> {
        User.responseAfterLogin(response)
        Toast.fire({
          icon: 'success',
          title: 'sign in successful'
        })
        this.$router.push({name:'dashboard'})

      })
    
      .catch(
        Toast.fire({
          icon: 'error',
          title: 'Invalid Email and password'
        })
        )

     
    }


  },

  created(){
    if (User.loggedIn()) {
         this.$router.push({name : 'dashboard'})
    }
  }


}
 
</script>