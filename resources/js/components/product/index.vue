<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">Product</strong></li>
      <li class="breadcrumb-item active"><strong>All</strong></li>
    </ol>

    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="addproduct">Add Product</router-link>
      </div>
    </div>
   
    <div>
      <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Product list
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width:200px"><br>
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr><th>id</th>
                    <th>Medicine</th>
                    <th>generic</th>
                    <th>Brand</th>
                    <th>Buying</th>
                    <th>MRP</th>
                    <th>Discount</th>
                    <th>Best_Price</th>
                    <th>Quantity</th>
                    <th>Images</th>
                    <th>Expiry_date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product,key in filtersearch" :key="product.id">
                    <td>{{++key}}</td>
                    <td>{{product.category.cat_name}}.{{product.product_name}} ({{product.unit_power}}) </td>
                    <td>{{product.generic_name}}  </td>
                    <td>{{product.brand.brand_name}}  </td>
                    <td>{{product.buying_price}} Tk</td>
                    <td>{{product.mrp}} Tk</td>
                    <td class="badge bg-danger">{{product.discount}} % off</td>
                    <td >{{product.best_price}} tk</td>
                    <td>{{product.stock_quantity  }} Piece</td>
                    <td>
                      <img :src="product.product_image" style="height:120px ; width: 150px;">
                    </td>

                    <td>
                      {{product.expiry_date }}
                    </td>
                    <td>
                      <router-link :to="{name:'editproduct',params:{id:product.id}}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></router-link>
                      <a @click="deleteProduct(product.id)" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
      products:[],
      searchTerm:'', 
    }
  },


  computed:{

    filtersearch(){
     return this.products.filter(product=>{
       return product.product_name.match(this.searchTerm);
      })
    }
},


  methods:{
   allproduct(){
    axios.get('/api/product/')
    .then(({data})=>{this.products=data})
    .catch()
   },


   deleteProduct(id){
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
          axios.delete('/api/product/'+id)
          .then(()=>{
            this.products=this.products.filter(product=>{
             return product.id!=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'allproduct'})
          })
          Swal.fire(
            'Deleted!',
            'Product delete success',
            'success'
          )
        }
      })
    
   },
 
  },

  created(){
    this.allproduct();
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }

  }


}
</script>


<style>
  
</style>
