import { createRouter, createWebHistory } from 'vue-router'
import PageVideos from "@/customers/views/customers/videos/index.vue";
import LayoutCustomers  from "@/customers/commons/Layouts/index.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      meta: {layout: LayoutCustomers},
      component: () => import('@/customers/views/Login/index.vue')
    },
    {
      path: '/videos',
      name: 'videos',
      component: PageVideos,
      // beforeEnter: guards.AuthUser,
      meta: {layout: LayoutCustomers},
    },

  ],
})

export default router
