<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">Stock</strong></li>
      <li class="breadcrumb-item active"><strong>All</strong></li>
    </ol>
    <div>
    
    </div>
    <div>
      <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Stock list
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
                    <th>Quantity</th>
                    <th>Images</th>
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
                    <td >{{product.discount}} % off</td>
                    <td class="badge bg-danger">{{product.stock_quantity  }} Piece</td>
                    <td>
                      <img :src="product.product_image" style="height:120px ; width: 150px;">
                    </td>

                    
                    <td>
                      <router-link :to="{name:'editstock',params:{id:product.id}}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></router-link>

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
    axios.get('/api/stock/')
    .then(({data})=>{this.products=data})
    .catch()
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
