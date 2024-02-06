<script setup>
import Anchor from "@/components/anchors/Anchor.vue";
import AnchorAccordion from "@/components/anchors/AnchorAccordion.vue";
import { useUtilsStore } from "@/stores/utils";

const utilsStore = useUtilsStore();
</script>

<template>
  <aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="[
      utilsStore.sideBarShow
        ? 'translate-x-0 ease-out'
        : '-translate-x-full ease-in',
    ]"
    aria-label="Sidebar"
  >
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <li>
          <Anchor to="/dashboard" icon="md-dashboard" name="Panel de control" />
        </li>
        <li>
          <AnchorAccordion name="Usuarios" icon="fa-users">
            <Anchor to="/people" icon="fa-user-tie" name="Clientes" />
            <Anchor to="/users" icon="fa-users-cog" name="Usuarios" />
          </AnchorAccordion>
        </li>
        <li>
          <Anchor to="/sales" icon="md-pointofsale" name="Ventas" />
        </li>
        <li>
          <Anchor to="/boxes" icon="fa-box" name="Cajas" />
        </li>
        <li>
          <AnchorAccordion name="Productos" icon="fa-store">
            <Anchor to="/categories" icon="fa-layer-group" name="Categorías" />
            <Anchor to="/products" icon="fa-shopping-cart" name="Productos" />
          </AnchorAccordion>
        </li>
        <li>
          <AnchorAccordion name="Operaciones" icon="fa-list">
            <Anchor
              to="/operations-type"
              icon="fa-clipboard-list"
              name="Tipo de operación"
            />
            <Anchor to="/operations" icon="fa-book" name="Operaciones" />
          </AnchorAccordion>
        </li>
        <li>
          <Anchor to="/configurations" icon="fa-toolbox" name="Configuración" />
        </li>
      </ul>
    </div>
  </aside>
</template>
