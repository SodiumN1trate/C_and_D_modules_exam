// import './assets/main.css'
import './assets/bootstrap.min.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(App)

axios.defaults.baseURL = import.meta.env.VITE_API_ADDRESS
axios.defaults.headers['authorization'] = 'Bearer ' + localStorage.getItem('token')

app.use(router)
app.use(VueAxios, axios)

app.mount('#app')
