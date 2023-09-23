<template>
  <div>
    
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">Brand</strong></li>
      <li class="breadcrumb-item active"><strong>All Brand</strong></li>
    </ol>

    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="allbrand">All Brand</router-link>
      </div>
    </div>
  
    <div>
      
      <div class="card-body">
    
      <form @submit.prevent="brandInsert" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-8">
              <label for="exampleInputEmail1">Brand name</label>
              <input type="text" v-model="form.brand_name" class="form-control" aria-describedby="emailHelp" placeholder="Brand name">
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="col-md-3">
              <input type="file" name="brand_logo" @change="onImageChange" accept="image/*"/>
            </div>
            <div class="col-md-8">
              <img :src="form.brand_logo" style="height:200px ; width: 250px;">
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
      brand_name:'',
      brand_logo:'',
    },
    errors:{},
  }

},

methods:{

brandInsert(){
    axios.post('/api/brand/',this.form)
    .then(()=>{
      Toast.fire({
          icon: 'success',
          title: 'brand added success'
        })

      this.$router.push({name:'allbrand'})

    })
    
  },



    onImageChange(event){
      let input =event.target;
      if(input.files && input.files[0]){
        let reader=new FileReader();
        reader.onload=(event)=>{
          this.form.brand_logo=event.target.result;
        }
        reader.readAsDataURL(input.files[0])
      }
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
