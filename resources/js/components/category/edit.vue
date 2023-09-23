<template>
  <div>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">category</strong></li>
      <li class="breadcrumb-item active"><strong>Update</strong></li>
    </ol>

    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="allbrand">All category</router-link>
      </div>
    </div><br>
    <div>
      <div class="card-header">category Update</div>
      <div class="card-body">
        <h4 class="text-danger" v-if="errors.cat_name">{{errors.category_name[0]}}
        </h4>
        <form @submit.prevent="categoryUpdate" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-8">
                <label for="exampleInputEmail1">category name</label>
                <input type="text" v-model="form.cat_name" class="form-control" aria-describedby="emailHelp" placeholder="category name">
              </div>
            </div>
            <hr>
            <div class="form-row">
              <div class="col-md-4">
                <input type="file" name="cat_image" class="btn btn-info" @change="onImageChange" accept="image/*"/>
              </div>
              <div class="col-md-8">
                <img :src="form.cat_image" style="height:200px ; width: 250px;">
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Update</button>
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

   categoryUpdate(){

    let id=this.$route.params.id
    axios.patch('/api/category/'+id,this.form)
    .then(()=>{
      Toast.fire({
          icon: 'success',
          title: 'Category Update success'
        })
       this.$router.push({name:'allcategory'})
    })
   } 
  },

  created(){

    let id=this.$route.params.id
    axios.get('/api/category/'+id)
    .then(({data})=>{this.form=data})
    .catch()

    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }
  }


  }
  </script>
  <style>
  
  </style>
  