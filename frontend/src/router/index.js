import { createRouter, createWebHistory } from "vue-router";
import { useProfileStore } from "@/stores/profile";

import Admin from "@/templates/Layout.vue";
import Auth from "@/templates/Auth.vue";

// views for admin layout
import Dashboard from "@/views/admin/Dashboard.vue";
import People from "@/views/admin/People.vue";
import Category from "@/views/admin/Category.vue";
import Product from "@/views/admin/Product.vue";
import Sale from "@/views/admin/Sale.vue";
import Box from "@/views/admin/Box.vue";
import OperationType from "@/views/admin/OperationType.vue";
import Operation from "@/views/admin/Operation.vue";

// Forms
import Profile from "@/views/forms/ProfileForms.vue";
import UpdatePassword from "@/views/forms/UpdatePassword.vue";
import PersonForms from "@/views/forms/PersonForms.vue";
import CategoryForms from "@/views/forms/CategoryForms.vue";
import ProductForms from "@/views/forms/ProductForms.vue";
import BoxForms from "@/views/forms/BoxForms.vue";
import OperationTypeForms from "@/views/forms/OperationTypeForms.vue";
import OperationForms from "@/views/forms/OperationForms.vue";

// views for Auth layout
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
        // Configuración
        {
          path: "/profile",
          component: Profile,
        },
        {
          path: "updatePassword",
          component: UpdatePassword,
        },
        // Clientes
        {
          path: "/people",
          component: People,
        },
        {
          path: "/newPerson",
          component: PersonForms,
        },
        {
          path: "/updatePerson",
          component: PersonForms,
        },
        // Productos
        {
          path: "/category",
          component: Category,
        },
        {
          path: "/newCategory",
          component: CategoryForms,
        },
        {
          path: "/updateCategory",
          component: CategoryForms,
        },
        {
          path: "/product",
          component: Product,
        },
        {
          path: "/newProduct",
          component: ProductForms,
        },
        {
          path: "/updateProduct",
          component: ProductForms,
        },
        // Sale
        {
          path: "/sale",
          component: Sale,
        },
        // Operacion

        {
          path: "/box",
          component: Box,
        },
        {
          path: "/newBox",
          component: BoxForms,
        },
        {
          path: "/updateBox",
          component: BoxForms,
        },
        {
          path: "/operationType",
          component: OperationType,
        },
        {
          path: "/newOperationType",
          component: OperationTypeForms,
        },
        {
          path: "/updateOperationType",
          component: OperationTypeForms,
        },
        {
          path: "/operation",
          component: Operation,
        },
        {
          path: "/newOperation",
          component: OperationForms,
        },
        {
          path: "/updateOperation",
          component: OperationForms,
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
    const isAuthenticated = true;
    if (!isAuthenticated) {
      next("/auth/login");
    } else {
      next();
    }
  } else {
    next();
  }

  // let ok = false;
  // let path = "";
  // const profileStore = useProfileStore();
  // if (!profileStore.isAuthenticated) {
  //   try {
  //     // verificar token
  //   } catch (error) {
  //     console.error("Error loading user data:", error);
  //   }
  // }
  // if (to.matched.some((record) => record.meta.requiresAuth)) {
  //   if (!profileStore.isAuthenticated) {
  //     path = "/auth/login";
  //     ok = false;
  //   } else {
  //     ok = true;
  //   }
  // }
  // if (to.matched.some((record) => record.meta.notAuthenticated)) {
  //   if (profileStore.isAuthenticated) {
  //     ok = false;
  //     path = "/";
  //   } else {
  //     ok = true;
  //   }
  // }
  // if (ok) {
  //   next();
  // } else {
  //   next({ path });
  // }
});

export default router;
