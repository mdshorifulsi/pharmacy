<template>
  <div>
    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="addexpense">Add Expense</router-link>
      </div>
    </div>
    <br>
    <div>
      <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Expense list
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
             
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr><th>id</th>
                    <th>expense Details</th>
                    <th>expense Amound</th>
                    <th>expense Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  	<tr v-for="expense,key in expenses" :key="expense.id">
                    <td>{{++key}}</td>
                    <td>{{expense.details}}</td>
                    <td>{{expense.Amount}} Tk</td>
                    <td>{{expense.expense_date}}</td>
                    
                    <td>

                      <router-link :to="{name:'editexpense',params:{id:expense.id}}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></router-link>
                      
                      <a @click="deleteExpense(expense.id)" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default{
  data(){
    return{
      expenses:{},
    
    }
  },


 

  methods:{

   allexpense(){
    axios.get('/api/expense/')
    .then(({data})=>{this.expenses=data})
    .catch()
   },


   deleteExpense(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get('/api/deleteexpense/'+id)
          .then(()=>{
            this.expenses=this.expenses.filter(expense=>{
             return expense.id!=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'allexpense'})
          })
          Swal.fire(
            'Deleted!',
            'Your expense deleted.',
            'success'
          )
        }
      })
    
   },
 
  },

  created(){
    this.allexpense();
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }

  }


}
</script>


<style>
  
</style>
