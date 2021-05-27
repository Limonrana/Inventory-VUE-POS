require('./bootstrap');
window.Vue = require('vue')
import router from './router'

//User Helper Class Import
import User from './helpers/User'
window.User = User

//Notification Helper Class Import
import Notification from './helpers/Notification'
window.Notification = Notification

//Sweet Alert Import Start
import Swal from 'sweetalert2'
window.Swal = Swal

//iView UI Import
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

import viewnoty from './helpers/view-noty'
Vue.mixin(viewnoty)

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast
//End Sweet Alert

// const routers = new VueRouter({
//     routes
// })
const app = new Vue({
    el: '#app',
    router,
})
