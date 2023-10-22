import { createRouter, createWebHistory } from "vue-router";

import Admin from "@/templates/Layout.vue";
import Auth from "@/templates/Auth.vue";

import Dashboard from "@/views/admin/Dashboard.vue";

import Login from "@/views/auth/Login.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      redirect: "/dashboard",
      component: Admin,
      meta: { requiresAuth: true },
      children: [
        {
          path: "/dashboard",
          component: Dashboard,
        },
      ],
    },
    {
      path: "/auth",
      redirect: "/auth/login",
      component: Auth,
      meta: { notAuthenticated: true },
      children: [
        {
          path: "/auth/login",
          component: Login,
        },
      ],
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
  ],
});

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // acceso a admin
    const isAuthenticated = false;
    if (!isAuthenticated) {
      next("/auth/login");
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
