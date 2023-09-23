<template>
	<div>
		 <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link to="/dashboard">Dashboard</router-link>
          </li>   
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{todaysell}} Tk</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Sell</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">{{income}} TK</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Income</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">{{due}} Tk</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Due</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">{{expense}} Tk</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today expense</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Stockout Medicine list
          </div>
          <div class="card-body">
            <div class="table-responsive">
             
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr><th>id</th>
                    <th>Medicine</th>
                    <th>generic</th>
                    <th>Best_Price</th>
                    <th>Quantity</th>
                    <!-- <th>Images</th> -->
                    <th>Expiry_date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product,key in stockouts" :key="product.id">
                    <td>{{++key}}</td>
                    <td>{{product.product_name}} ({{product.unit_power}}) </td>
                    <td>{{product.generic_name}}  </td>
                    <td >{{product.best_price}} tk</td>
                    <td class="badge bg-success">{{product.stock_quantity  }} Piece</td>
                    <!-- <td>
                      <img :src="product.product_image" style="height:120px ; width: 150px;">
                    </td> -->

                    <td>
                      {{product.expiry_date }}
                    </td>
                  
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
            
          </div>

          <div class="col-md-6">
            <div class="card-body">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> Date Expire Medicine
          </div>
          <div class="card-body">
            <div class="table-responsive">
             
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr><th>id</th>
                    <th>Medicine</th>
                    <th>generic</th>
                    <th>MRP</th>
                    <th>Quantity</th>
                    <!-- <th>Images</th> -->
                    <th  class="badge bg-danger">Expiry_date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="expirydate,key in expirydate" :key="expirydate.id">
                    <td>{{++key}}</td>
                    <td>{{expirydate.product_name}} ({{expirydate.unit_power}}) </td>
                    <td>{{expirydate.generic_name}}  </td>
             

                    <td>{{expirydate.mrp}} Tk</td>
                    
                    <td>{{expirydate.stock_quantity  }} Piece</td>
                 

                    <td  class="badge bg-danger">
                      {{expirydate.expiry_date }}
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
        


	</div>
</template>

<script>
 export default {

  created(){ 
    if (!User.loggedIn()) {
         this.$router.push({name : 'login'})
    }

   
  },


  data(){
    return{
      todaysell:'',
      income:'',
      due:'',
      expense:'',
      stockouts:'',
      expirydate:'',
 
    }
  },

mounted(){
     this.TodaySell();
     this.todayincome();
     this.todayDue();
     this.todayexpense();
     this.stockout();
     this.Expirydate();
  
  },

  methods:{

    TodaySell(){
    axios.get('/api/todaysell/')
    .then(({data}) => (this.todaysell=data))
    .catch()
   },


   todayincome(){
    axios.get('/api/todayincome/')
    .then(({data}) => (this.income=data))
    .catch()
   },

   todayDue(){
    axios.get('/api/todaydue/')
    .then(({data}) => (this.due=data))
    .catch()
   },

   todayexpense(){
    axios.get('/api/todayexpense/')
    .then(({data}) => (this.expense=data))
    .catch()
   },


stockout(){
    axios.get('/api/stockout/')
    .then(({data}) => (this.stockouts=data))
    .catch()
   },


   Expirydate(){
    axios.get('/api/expirydate/')
    .then(({data}) => (this.expirydate=data))
    .catch()
   },



  

  }

}
</script>