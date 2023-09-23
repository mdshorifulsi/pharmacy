<template>
  <div>
      <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All Order list
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <br>
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Order Date</th>
                    <th>customer name</th>
                    <th>phone number</th>
                    <th>Sub Total</th>
                    <th>Pay</th>
                    <th>Due</th>
                    <th>payby</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="order,key in orders" :key="order.id">
                    <td>{{++key}}</td>
                    <td>{{order.order_date}}</td>
                    <td>{{order.customer_name}}</td>
                    <td>{{order.phone_number}}</td>
                    <td>{{order.sub_total}}</td>
                    <td>{{order.pay}}</td>
                    <td>{{order.due}}</td>
                    <td>{{order.payby}}</td>
                    <td>
                      <router-link :to="{name:'orderdetails',params:{id:order.id}}" class="btn btn-sm btn-success"><i class="bi bi-eye"></i>
                      </router-link>

                      <a @click="deleteOrder(order.id)" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    </td> 
                  </tr>
                </tbody>
              </table>
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
      orders:[],
      searchTerm:'',
    }
  },




  methods:{


   allorder(){
    axios.get('/api/allorder/')
    .then(({data})=>{this.orders=data})
    .catch()
    
   },

  deleteOrder(id){

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
          axios.get('/api/order_delete/'+id)
          .then(()=>{
            this.orders=this.orders.filter(order=>{
             return order.id!=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'allorder'})
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    
   },
 


  },

  created(){
    this.allorder();
    
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }

  }


}
</script>


<style>
  
</style>
