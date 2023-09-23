<template>
  <div>
    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="allexpense">All Expense</router-link>
      </div>
    </div>
  
    <div>
      <div class="card-header"><router-link to="/"> <strong>Home</strong></router-link> <strong class="text-danger"> ></strong> <router-link to="/allexpense"> <strong class="text-success">Expense</strong></router-link> <strong class="text-danger"> ></strong> Insert</div>
      <div class="card-body">
    
      <form @submit.prevent="expenseInsert" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleInputEmail1">Expense details</label>
              <input type="text" v-model="form.details" class="form-control" aria-describedby="emailHelp" placeholder="Expense details">
            </div>
          

          </div>

          <div class="form-row">
           
            <div class="col-md-6">
              <label for="exampleInputEmail1">Expense Amound</label>
              <input type="text" v-model="form.Amount" class="form-control" aria-describedby="emailHelp" placeholder="Expense Amount">
            </div>

          </div>
        
         
        </div>
        <button class="btn btn-primary" type="submit">submit</button>
      </form>
    </div>
  </div>
</div>
</template>


<script>
export default{

 data(){
  return {
    form:{
      details:'',
      Amount:'',
    },
  
  }

},

methods:{

expenseInsert(){
    axios.post('/api/addexpense/',this.form)
    .then(()=>{
      Toast.fire({
          icon: 'success',
          title: 'Expense added success'
        })

      this.$router.push({name:'allexpense'})

    })
    
  },



    
  },

  created(){
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }
  }
}



</script>
<style>

</style>
