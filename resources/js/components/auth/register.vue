<template>
  <div>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Regiser A New Account</div>
  <div class="card-body">
        <form @submit.prevent="signup">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Full Name"  autofocus="autofocus" v-model="name">
               
              <label for="inputEmail">Full Name</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address"  autofocus="autofocus" v-model="email" >
              
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" v-model="password" >
              
              <label for="inputPassword">Password</label>
            </div>
          </div>
           <div class="form-group">
            <div class="form-label-group">
              <input type="password"  class="form-control" placeholder="Re-type Password" v-model="confirm_password"  >
              <label for="inputPassword">confirm password</label>
              
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
       
      </div>
    </div>
  </div>
      </template>



<script>
 export default {
 
  created(){
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }
  },


  
  data(){
    return {
      form:{
        name: null,
        email: null,
        password: null,
        confirm_password: null
      },
     
    }
  },
  methods:{
    signup(){
      axios.post('/api/auth/signup',this.form)
      .then(res => { 
        User.responseAfterLogin(res)
        Toast.fire({
          type: 'success',
          title: 'Signed in successfully'
        })
        this.$router.push({ name : 'dashboard'})
      })
      .catch()
    }
  }

}
</script>