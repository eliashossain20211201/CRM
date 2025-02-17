/* import Vue from 'vue';
import App from './App.vue';
import store from './store';
import router from './router';
import axios from './axios';  // Axios configuration

axios.defaults.baseURL = 'http://your-api-url.com';

Vue.config.productionTip = false;

new Vue({
  store,
  router,
  render: h => h(App),
}).$mount('#app');
 */
// src/main.js
import { createApp } from 'vue';  // Use 'createApp' for Vue 3
import App from './App.vue';
import router from './router';  // Import the router
import store from './store';  // Import the updated Vuex store

/* const app = createApp(App);  // Use createApp for Vue 3

  
// Use Vuex store in Vue app
app.use(store);
app.use(router);
app.mount('#app');  // Mount the app */

createApp(App)
  .use(store)
  .use(router)
  .mount('#app');