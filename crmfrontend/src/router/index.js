import { createRouter, createWebHistory } from 'vue-router';  
import store from '@/store'; // Import Vuex store
import LeadDashboard from '@/components/LeadDashboard.vue';
import UserLogin from '@/components/UserLogin.vue';

const routes = [
  { path: '/login', component: UserLogin },
  {
    path: '/',
    component: LeadDashboard,
    beforeEnter: (to, from, next) => {
      if (!store.getters.isAuthenticated) {  // Use store directly
        return next('/login');
      }
      next();
    },
  },
];

const router = createRouter({
  history: createWebHistory(),  
  routes,
});

export default router;
