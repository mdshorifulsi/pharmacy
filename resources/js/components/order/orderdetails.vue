<template>
  <div>
       <!--  <div class="card-header">
          <router-link class="btn btn-primary" to="allorder"> All order
          </router-link>
        </div> -->
        <div class="card-header">Order Details</div><br>
        <div class="card-header">
          <div class="row">
            <div class="col-md-4">
              <strong class="text-danger">Customer Details</strong><br>
              Customer Name : {{order.customer_name}}<br>
              Phone Number : {{order.phone_number}}<br>
              Product Quantity : {{order.qty}} <br>
              sub total : {{order.sub_total}} Tk <br>
              <strong class="text-danger"> 
              Total : {{order.total}} Tk </strong>
            </div>
            <div class="col-md-8">
              <strong class="text-danger">Product Details</strong>
              <div v-for="detail,key in details" :key="detail.id">
                product name: {{detail.product_name}} || Qty : {{detail.product_quantity}} KG ||  Unit price : {{detail.product_price}} Taka || {{detail.product_quantity}} *{{detail.product_price}} = Subtotal : {{detail.sub_total}} Taka
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>

</template>


<script>

export default{

   

  data(){
    return {
      order:{},
      details:{},
    }
  },

 
  created(){

    let oid=this.$route.params.id
    axios.get('/api/order/'+oid)
    .then(({data})=>{
        this.order=data
    })
    .catch()


    let id=this.$route.params.id
    axios.get('/api/order/details/'+id)
    .then(({data})=>{
        this.details=data
    })
    .catch();

    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }
   
  },

 }
</script>
<style>
  
</style>
