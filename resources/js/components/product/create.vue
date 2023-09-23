<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">Product</strong></li>
      <li class="breadcrumb-item active"><strong>Insert</strong></li>
    </ol>

    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="allproduct">All Product</router-link>
      </div>
    </div>
  
    <div>
     
      <div class="card-body">
    
      <form @submit.prevent="productInsert" enctype="multipart/form-data">
        <div class="form-row">
              <div class="col-md-5">
                <label for="exampleInputEmail1">Medicine name</label>
                <input type="text" v-model="form.product_name" class="form-control" aria-describedby="emailHelp" placeholder="Medicine name">
              </div>

              <div class="col-md-5">
                <label for="exampleInputEmail1">Generic name</label>
                <input type="text" v-model="form.generic_name" class="form-control" aria-describedby="emailHelp" placeholder="Generic name">
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1">Medicine Power</label>
                <input type="text" v-model="form.unit_power" class="form-control" aria-describedby="emailHelp" placeholder="Power(mg/ml)">
              </div>
           
          
        </div>

         <div class="form-row">
          <div class="col-md-3">
                 <label for="exampleInputEmail1">category</label>
              <select class="form-select" v-model="form.category_id"  aria-label="Default select example" >
        
              <option :value="category.id" v-for="category in categories">
               {{ category.cat_name}}
              </option>
            </select>
              </div>

          <div class="col-md-3">
                 <label for="exampleInputEmail1">brand</label>
              <select class="form-select" v-model="form.brand_id" aria-label="Default select example" >
              <option :value="brand.id" v-for="brand in brands">
               {{ brand.brand_name}}
              </option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="exampleInputEmail1">stock_quantity</label>
            <input type="text" v-model="form.stock_quantity" class="form-control" aria-describedby="emailHelp" placeholder="stock quantity">
          </div>

          <div class="col-md-3">
            <label for="exampleInputEmail1">Buying price</label>
            <input type="text" v-model="form.buying_price" class="form-control" aria-describedby="emailHelp" placeholder="Buying price">
          </div>
        </div>

        <div class="form-row">

          <div class="col-md-3">
            <label for="exampleInputEmail1">MRP</label>
            <input type="text" v-model="form.mrp" class="form-control" aria-describedby="emailHelp" placeholder="MRP ">
          </div>

          <div class="col-md-3">
            <label for="exampleInputEmail1">Discount price</label>
            <input type="text" v-model="form.discount" class="form-control" aria-describedby="emailHelp" placeholder="Discount">
          </div>

          <div class="col-md-3">
            <label for="exampleInputEmail1">Manufacture date</label>
            <input type="date" v-model="form.manufacture_date" class="form-control" aria-describedby="emailHelp" placeholder="Manufacture date">
          </div>
          <div class="col-md-3">
            <label for="exampleInputEmail1">expiry_date</label>
            <input type="date" v-model="form.expiry_date" class="form-control" aria-describedby="emailHelp" placeholder="expiry_date ">
          </div>
        </div>
        <br>
        <div class="form-row">
          <div class="col-md-4">
            <input type="file" name="product_image"  @change="onImageChange" accept="image/*"/>
          </div>
          <div class="col-md-5">
            <img :src="form.product_image" style="height:200px ; width: 250px;">
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
        category_id:'', 
        brand_id:'',
        product_name:'',
        generic_name:'',
        unit_power:'',
        discount:'',
        buying_price:'',
        mrp:'',
        manufacture_date:'',
        expiry_date:'',
        product_image:'',
        stock_quantity:'',

    },
    errors:{},
    categories:{},
    brands:{},
  }

},

methods:{

productInsert(){
    axios.post('/api/product/',this.form)
    .then(()=>{
      Toast.fire({
          icon: 'success',
          title: 'product added success'
        })

      this.$router.push({name:'allproduct'})

    })
    
  },



    onImageChange(event){
      let input =event.target;
      if(input.files && input.files[0]){
        let reader=new FileReader();
        reader.onload=(event)=>{
          this.form.product_image=event.target.result;
        }
        reader.readAsDataURL(input.files[0])
      }
    },
  },

  created(){

    axios.get('/api/category/')
    .then(({data})=>{
      this.categories=data
    })

     axios.get('/api/brand/')
     .then(({data})=>{
      this.brands=data

     })

     if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }
    
  }
}



</script>
<style>

</style>
