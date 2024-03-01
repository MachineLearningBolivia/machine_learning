import { createRouter, createWebHistory } from "vue-router";
import { useProfileStore } from "@/stores/profile";

import Admin from "@/templates/Layout.vue";
import Auth from "@/templates/Auth.vue";

// views for admin layout
import Dashboard from "@/views/admin/Dashboard.vue";
import User from "@/views/admin/User.vue";
import Person from "@/views/admin/Person.vue";
import Category from "@/views/admin/Category.vue";
import Categoria from "@/views/admin/Categoria.vue";
import Product from "@/views/admin/Product.vue";
import Maquina from "@/views/admin/Maquina.vue";
import Sale from "@/views/admin/Sale.vue";
import Box from "@/views/admin/Box.vue";
import OperationType from "@/views/admin/OperationType.vue";
import Operation from "@/views/admin/Operation.vue";
import Configuration from "@/views/admin/Configuration.vue";

// Forms
import Profile from "@/views/forms/ProfileForm.vue";
import UpdatePassword from "@/views/forms/UpdatePassword.vue";
import UserForm from "@/views/forms/UserForm.vue";
import PersonForm from "@/views/forms/PersonForm.vue";
import CategoryForm from "@/views/forms/CategoryForm.vue";
import CategoriaForm from "@/views/forms/CategoriaForm.vue";
import ProductForm from "@/views/forms/ProductForm.vue";
import MaquinaForm from "@/views/forms/MaquinaForm.vue";
import SaleForm from "@/views/forms/SaleForm.vue";
import BoxForm from "@/views/forms/BoxForm.vue";
import OperationTypeForm from "@/views/forms/OperationTypeForm.vue";
import OperationForm from "@/views/forms/OperationForm.vue";
import ConfigurationForm from "@/views/forms/ConfigurationForm.vue";

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
        // Home
        {
          path: "/dashboard",
          component: Dashboard,
        },
        // Perfil de usuario
        {
          path: "/profile",
          component: Profile,
        },
        {
          path: "/update/password",
          component: UpdatePassword,
        },
        // Usuarios
        {
          path: "/users",
          component: User,
        },
        {
          path: "/new/users",
          component: UserForm,
        },
        {
          path: "/update/users",
          component: UserForm,
        },
        // Clientes
        {
          path: "/people",
          component: Person,
        },
        {
          path: "/new/people",
          component: PersonForm,
        },
        {
          path: "/update/people",
          component: PersonForm,
        },
        // Categorías
        {
          path: "/categories",
          component: Category,
        },
        {
          path: "/new/categories",
          component: CategoryForm,
        },
        {
          path: "/update/categories",
          component: CategoryForm,
        },
        {
          path: "/categorias",
          component: Categoria,
        },
        {
          path: "/new/categorias",
          component: CategoriaForm,
        },
        {
          path: "/update/categorias",
          component: CategoriaForm,
        },
        // Productos
        {
          path: "/products",
          component: Product,
        },
        {
          path: "/new/products",
          component: ProductForm,
        },
        {
          path: "/update/products",
          component: ProductForm,
        },
        // Maquinas
        {
          path: "/maquinaria",
          component: Maquina,
        },
        {
          path: "/new/maquinaria",
          component: MaquinaForm,
        },
        {
          path: "/update/maquinaria",
          component: MaquinaForm,
        },
        // Ventas
        {
          path: "/sales",
          component: Sale,
        },
        {
          path: "/new/sales",
          component: SaleForm,
        },
        {
          path: "/update/sales",
          component: SaleForm,
        },
        // Tipos de operaciones
        {
          path: "/operations-type",
          component: OperationType,
        },
        {
          path: "/new/operations-type",
          component: OperationTypeForm,
        },
        {
          path: "/update/operations-type",
          component: OperationTypeForm,
        },
        // Operaciones
        {
          path: "/operations",
          component: Operation,
        },
        {
          path: "/new/operations",
          component: OperationForm,
        },
        {
          path: "/update/operations",
          component: OperationForm,
        },
        // Cajas
        {
          path: "/boxes",
          component: Box,
        },
        {
          path: "/new/boxes",
          component: BoxForm,
        },
        {
          path: "/update/boxes",
          component: BoxForm,
        },
        // Configuraciones
        {
          path: "/configurations",
          component: Configuration,
        },
        {
          path: "/new/configurations",
          component: ConfigurationForm,
        },
        {
          path: "/update/configurations",
          component: ConfigurationForm,
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

router.beforeEach(async (to, from, next) => {
  let ok = false;
  let path = "";
  const profileStore = useProfileStore();

  if (!profileStore.isAuthenticated) {
    try {
      await profileStore.verifyToken();
    } catch (error) {
      console.error("Error loading user data:", error);
    }
  }

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!profileStore.isAuthenticated) {
      path = "/auth/login";
      ok = false;
    } else {
      ok = true;
    }
  }

  if (to.matched.some((record) => record.meta.notAuthenticated)) {
    if (profileStore.isAuthenticated) {
      ok = false;
      path = "/";
    } else {
      ok = true;
    }
  }

  if (ok) {
    next();
  } else {
    next({ path });
  }
});

export default router;
