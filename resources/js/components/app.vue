<template>
	<div>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top" id="topbar" style="display: none;"  v-show="$route.path === '/'  ? false : true " >
      <router-link class="navbar-brand mr-1" to="/">
        <img id="image-area" :src="image" />
        Pharmacy
      </router-link>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
 

    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     
    </ul>
  </nav>

  <div id="wrapper">
    <!-- Sidebar -->
      <!-- Sidebar -->
    <ul class="sidebar navbar-nav" id="leftbar" v-show="$route.path === '/' ? false : true "  style="display: none;">

   

      <li class="nav-item">
        <router-link class="nav-link" to="/dashboard">
           <i class="fas fa-fw fa-folder"></i>
          <span> Dashboard</span>
        </router-link>
      </li>

    


      <li class="nav-item">
        <router-link class="nav-link" to="allcategory">
           <i class="fas fa-fw fa-folder"></i>
          <span> category</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="allbrand">
           <i class="fas fa-fw fa-folder"></i>
          <span> Brand</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="allproduct">
           <i class="fas fa-fw fa-folder"></i>
          <span> product</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="allstock">
           <i class="fas fa-fw fa-folder"></i>
          <span> Stock</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="allexpense">
           <i class="fas fa-fw fa-folder"></i>
          <span> Expense</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="pos">
           <i class="fas fa-fw fa-folder"></i>
          <span> POS</span>
        </router-link>
      </li>


      <li class="nav-item">
        <router-link class="nav-link" to="allorder">
           <i class="fas fa-fw fa-folder"></i>
          <span>Order</span>
        </router-link>
        </li>

      <hr>

      <li class="nav-item">
        <router-link class="nav-link" to="/logout">
           <i class="fas fa-fw fa-folder"></i>
          <span> Logout</span>
        </router-link>
      </li>

     

    </ul>

    <div id="content-wrapper">
      <div class="container-fluid">
       
        <router-view></router-view>
        
      </div>
    </div>
  </div>
		
 
	</div>
	
</template>

<script >

let token = localStorage.getItem('token');
   if (token) {
    $("#topbar").css("display","");
    $("#leftbar").css("display","");
   }

 </script>
