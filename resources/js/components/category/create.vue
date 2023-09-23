<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">category</strong></li>
      <li class="breadcrumb-item active"><strong>Insert</strong></li>
    </ol>
    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="allcategory">All Category</router-link>
      </div>
    </div>
  
    <div>
      
      <div class="card-body">
    
      <form @submit.prevent="categoryInsert" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-8">
              <label for="exampleInputEmail1">Category name</label>
              <input type="text" v-model="form.cat_name" class="form-control" aria-describedby="emailHelp" placeholder="Category name">
            </div>
          </div>
          <hr>
          <div class="form-row">
            <div class="col-md-3">
              <input type="file" name="cat_image" @change="onImageChange" accept="image/*"/>
            </div>
            <div class="col-md-8 ">
              <img :src="form.cat_image" style="height:200px ; width: 250px;">
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
      cat_name:'',
      cat_image:'',
    },
    errors:{},
  }

},

methods:{

categoryInsert(){
    axios.post('/api/category/',this.form)
    .then(()=>{
      Toast.fire({
          icon: 'success',
          title: 'category added success'
        })

      this.$router.push({name:'allcategory'})

    })
    
  },



    onImageChange(event){
      let input =event.target;
      if(input.files && input.files[0]){
        let reader=new FileReader();
        reader.onload=(event)=>{
          this.form.cat_image=event.target.result;
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
