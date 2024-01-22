<script setup>
import Anchor from "@/components/anchor/Anchor.vue";
import AnchorAccordion from "@/components/anchor/AnchorAccordion.vue";
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
          <Anchor to="/dashboard" icon="fa-chart-pie" name="Panel de control" />
        </li>
        <li>
          <Anchor to="/people" icon="fa-users" name="Clientes" />
        </li>
        <li>
          <Anchor to="/sale" icon="fa-chart-bar" name="Ventas" />
        </li>
        <li>
          <AnchorAccordion name="Productos" icon="fa-shopping-cart">
            <li>
              <Anchor to="/category" icon="fa-list-alt" name="Categorías" />
              <Anchor to="/product" icon="fa-cubes" name="Productos" />
            </li>
          </AnchorAccordion>
        </li>
        <li>
          <AnchorAccordion name="Operaciones" icon="fa-edit">
            <li>
              <Anchor to="/box" icon="fa-box" name="Cajas" />
              <Anchor
                to="/operationType"
                icon="fa-regular-edit"
                name="Tipo de operación"
              />
              <Anchor
                to="/operation"
                icon="fa-clipboard-list"
                name="Operaciones"
              />
            </li>
          </AnchorAccordion>
        </li>
        <li>
          <AnchorAccordion name="Configuración" icon="co-settings">
            <li>
              <Anchor to="/setting" icon="co-settings" name="Settings" />
            </li>
            <li>
              <Anchor to="/setting" icon="co-settings" name="Settings" />
            </li>
            <li>
              <Anchor to="/setting" icon="co-settings" name="Settings" />
            </li>
          </AnchorAccordion>
        </li>
      </ul>
    </div>
  </aside>
</template>
