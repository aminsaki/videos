import { createApp } from 'vue'
import { createPinia } from 'pinia'

import customerApp from './customers/App.vue'
import router from './router'

/// bootstrap
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import 'bootstrap/js/dist/popover.js';


const app = createApp(customerApp)
app.use(createPinia())
app.use(router)

app.mount('#app')
