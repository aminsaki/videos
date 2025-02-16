import { createRouter, createWebHistory } from 'vue-router'
import LayoutCustomers  from "@/customers/commons/Layouts/index.vue"
import * as guards from "./guard.js"

const routes = [
    {
      path: '/',
      name: 'login',
      meta: {layout: LayoutCustomers},
      component: () => import('@/customers/views/Login/index.vue')
    },
    {
      path: '/panel/dashboard',
      name: 'panel',
      meta: {layout: LayoutCustomers},
      beforeEnter: guards.AuthUser,
      component: () => import('@/customers/views/panel/dashboard.vue')
    }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),  // استفاده از import.meta.env
  routes
});

export default router;
