import { createRouter, createWebHistory } from 'vue-router';  // Correct imports for Vue 3
import { useStore } from 'vuex';  // Import useStore from Vuex
import LeadDashboard from '@/components/LeadDashboard.vue';
import UserLogin from '@/components/UserLogin.vue';

const routes = [
  { path: '/login', component: UserLogin },
  {
    path: '/',
    component: LeadDashboard,
    beforeEnter: (to, from, next) => {
      const store = useStore();  // Access Vuex store using useStore
      if (!store.getters.isAuthenticated) {  // Check authentication
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
