<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <router-link to="/dashboard"> <strong>Dashboard</strong></router-link>
      </li> 
      <li class="breadcrumb-item active"><strong class="text-success">category</strong></li>
      <li class="breadcrumb-item active"><strong>All</strong></li>
    </ol>

    <div>
      <div class="card-header">
        <router-link class="btn btn-primary" to="addcategory">Add Category</router-link>
      </div>
    </div>
    <div>
      <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Category list
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width:200px"><br>
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr><th>id</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="category,key in filtersearch" :key="category.id">
                    <td>{{++key}}</td><td>{{category.cat_name}}</td>
                    <td>
                      <img :src="category.cat_image" style="height:120px ; width: 150px;">
                    </td>
                    <td>
                      <router-link :to="{name:'editcategory',params:{id:category.id}}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></router-link>
                      <a @click="deleteCategory(category.id)" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
      categories:[],
      searchTerm:'', 
    }
  },


  computed:{

    filtersearch(){
     return this.categories.filter(category=>{
       return category.cat_name.match(this.searchTerm);
      })
    }
},


  methods:{
   allcategory(){
    axios.get('/api/category/')
    .then(({data})=>{this.categories=data})
    .catch()
   },


   deleteCategory(id){
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
          axios.delete('/api/category/'+id)
          .then(()=>{
            this.categories=this.categories.filter(category=>{
             return category.id!=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'allcategory'})
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
    this.allcategory();

    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }

  }


}
</script>


<style>
  
</style>
