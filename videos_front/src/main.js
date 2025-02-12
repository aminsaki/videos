import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios';
import VueAxios from 'vue-axios'
import customerApp from './customers/App.vue'
import router from './router'
import  "@/customers/assets/css/main_customers.scss"

/// bootstrap
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import 'bootstrap/js/dist/popover.js';
import '@/commons/assets/css/index.css'


// import webUrl from "../config/dev.json";
import webUrl from "../config/prod.json";
let token = localStorage.getItem('token');
axios.defaults.headers.common['Authorization'] = (token) ? token :  delete axios.defaults.headers.common['Authorization'];
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'X-Requested-With';
axios.defaults.baseURL = webUrl.BASE_URL


const app = createApp(customerApp)
app.use(createPinia())
app.use(VueAxios, axios)
app.use(router)
app.mount('#app')
