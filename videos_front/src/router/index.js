import { createRouter, createWebHistory } from 'vue-router'
import LayoutCustomers  from "@/customers/commons/Layouts/index.vue"
import * as guards from "./guard.js"
import notFound from "@/commons/errors/notFound.vue";

const routes = [
    {
      path: '/:uid',
      name: 'uid',
      meta: {layout: LayoutCustomers},
      component: () => import('@/customers/views/Login/index.vue')
    },
    {
      path: '/admin',
      name: 'login',
      meta: {layout: LayoutCustomers},
      component: () => import('@/customers/views/Login/index.vue')
    },
    {
      path: '/panel/dashboard',
      name: 'panel',
      meta: {layout: LayoutCustomers},
      beforeEnter: guards.paranGuards,
      component: () => import('@/customers/views/panel/index.vue')
    },
  {
    path: '/panel/dashboard/links',
    name: 'links',
    meta: {layout: LayoutCustomers},
    beforeEnter: guards.paranGuards,
    component: () => import('@/customers/views/panel/lists.vue')
  },
  {
    path: '/videos/:uid',
    name: 'videos',
    meta: {layout: LayoutCustomers},
    beforeEnter: guards.paranGuards,
    component: () => import('@/customers/views/videos/index.vue')
  },
  {
    path: "/:pathMatch(.*)*",
    name: "not-found",
    meta: {layout: notFound}
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),  // استفاده از import.meta.env
  routes
});

export default router;
