// Composables
import { createRouter, createWebHistory } from 'vue-router'
import {useGuestUserStore} from "@/store/guestUser";

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '',
        name: 'Home',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue'),
      },
      {
        path: '/game/:url',
        name: 'Game',
        component: () => import('@/views/Game.vue')
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  // Check if the token is set in the Pinia store and restore it
  const guestUserStore = useGuestUserStore();
  if (!guestUserStore.token) {
    // Retrieve the token from local storage or another source
    const token = localStorage.getItem('guestUserToken');
    guestUserStore.setToken(token);
  }

  next();
});

export default router
