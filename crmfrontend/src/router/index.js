import { createRouter, createWebHistory } from 'vue-router';  
//import store from '@/store'; // Import Vuex store
//import LeadDashboard from '@/components/LeadDashboard.vue';
import AdminDashboard from '@/components/AdminDashboard.vue';
import CounselorDashboard from '@/components/CounselorDashboard.vue';
import UserLogin from '@/components/UserLogin.vue';

const routes = [
  { path: '/login', component: UserLogin },
  { path: '/admin', component: AdminDashboard, meta: { requiresAuth: true, role: 'admin' }},
  { path: '/counselor', component: CounselorDashboard, meta: { requiresAuth: true, role: 'counselor' }},
  { path: '/', redirect: '/login' },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('auth_token');
  const userRole = localStorage.getItem('user_role');

  if (to.meta.requiresAuth && !isAuthenticated) {
    return next('/login');
  }

  if (to.meta.role && to.meta.role !== userRole) {
    return next('/');
  }

  next();
});

export default router;
