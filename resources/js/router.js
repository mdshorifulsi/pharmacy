
	import { createWebHistory,createRouter  } from 'vue-router';

	
    import login from './components/auth/login.vue';
    import logout from './components/auth/logout.vue';
    import dashboard from './components/dashboard.vue';
    import register from './components/auth/register.vue';


     import allcategory from './components/category/index.vue';
     import addcategory from './components/category/create.vue';
     import editcategory from './components/category/edit.vue';


     import allbrand from './components/brand/index.vue';
     import addbrand from './components/brand/create.vue';
     import editbrand from './components/brand/edit.vue';

     import allproduct from './components/product/index.vue';
     import addproduct from './components/product/create.vue';
     import editproduct from './components/product/edit.vue';
    
    import allstock from './components/stock/index.vue';
    import editstock from './components/stock/edit.vue';

    import allexpense from './components/expense/index.vue';
    import addexpense from './components/expense/create.vue';
    import editexpense from './components/expense/edit.vue';

    import pos from './components/pos/index.vue';

     import allorder from './components/order/index.vue';
     import orderdetails from './components/order/orderdetails.vue';

	

     

 	const routes = [


      {name:'login', path:'/',component:login},
      {name:'logout', path:'/logout',component:logout},
      {name:'dashboard', path:'/dashboard',component:dashboard},
      {name:'register', path:'/register',component:register},



      { path: '/allcategory', component: allcategory,name:'allcategory' },
      { path: '/addcategory', component: addcategory,name:'addcategory' },
      { path: '/editcategory:id', component: editcategory,name:'editcategory' },


      { path: '/allbrand', component: allbrand,name:'allbrand' },
      { path: '/addbrand', component: addbrand,name:'addbrand' },
      { path: '/editbrand:id', component: editbrand,name:'editbrand' },

      { path: '/allproduct', component: allproduct,name:'allproduct' },
      { path: '/addproduct', component: addproduct,name:'addproduct' },
      { path: '/editproduct:id', component: editproduct,name:'editproduct' },


      { path: '/allstock', component: allstock,name:'allstock' },
      { path: '/editstock:id', component: editstock,name:'editstock' },

      { path: '/allexpense', component: allexpense,name:'allexpense' },
      { path: '/addexpense', component: addexpense,name:'addexpense' },
      { path: '/editexpense:id', component: editexpense,name:'editexpense' },


    { path: '/pos', component: pos,name:'pos' },

      
      { path: '/allorder', component: allorder,name:'allorder' },
      { path: '/orderdetails:id', component: orderdetails,name:'orderdetails' },



    


      

      ];




   const router = createRouter({

   	history: createWebHistory(),
   	routes,

   });




   export default router;