import './bootstrap';
import { createApp } from 'vue'
import router from './router.js'
import App from './components/app.vue'


// start sweetalert2
import Swal from 'sweetalert2'
window.Swal=Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
})
window.Toast=Toast;



//import user class
import User from './Helpers/User';
window.User = User

createApp(App)
.use(router)
.mount('#app')


