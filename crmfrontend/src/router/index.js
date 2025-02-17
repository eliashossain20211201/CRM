import Vue from 'vue';
import { createRouter, createWebHistory } from 'vue-router';  // Correct imports for Vue 3
import LeadDashboard from '@/components/LeadDashboard.vue';
import UserLogin from '@/components/UserLogin.vue';

const routes = [
  { path: '/login', component: UserLogin },
  {
    path: '/',
    component: LeadDashboard,
    beforeEnter: (to, from, next) => {
      if (!Vue.prototype.$store.getters.isAuthenticated) {
        return next('/login');
      }
      next();
    },
  },
];

const router = createRouter({
  history: createWebHistory(),  // Create history for Vue 3 router
  routes,
});

export default router;
