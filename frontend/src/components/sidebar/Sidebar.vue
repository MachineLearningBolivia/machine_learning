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
          <Archor to="/dashboard" icon="fa-flipboard" name="Panel de control" />
        </li>
        <li>
          <Archor to="/people" icon="fa-users" name="Clientes" />
        </li>
        <li>
          <Archor to="/sale" icon="fa-chart-bar" name="Ventas" />
        </li>
        <li>
          <ArchorAccordion name="Productos" icon="fa-shopping-cart">
            <li>
              <Archor to="/category" icon="fa-list-alt" name="Categorias" />
              <Archor to="/product" icon="fa-cubes" name="Productos" />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <ArchorAccordion name="Operaciones" icon="fa-edit">
            <li>
              <Archor to="/box" icon="fa-box" name="Cajas" />
              <Archor
                to="/operationType"
                icon="fa-regular-edit"
                name="Tipo de operación"
              />
              <Archor
                to="/operation"
                icon="fa-clipboard-list"
                name="Operaciones"
              />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <ArchorAccordion name="Configuración" icon="co-settings">
            <li>
              <Archor to="/setting" icon="co-settings" name="Settings" />
            </li>
            <li>
              <Archor to="/setting" icon="co-settings" name="Settings" />
            </li>
            <li>
              <Archor to="/setting" icon="co-settings" name="Settings" />
            </li>
          </ArchorAccordion>
        </li>
      </ul>
    </div>
  </aside>
</template>
<script setup>
import Archor from "@/components/archor/Archor.vue";
import ArchorAccordion from "@/components/archor/ArchorAccordion.vue";
import { useUtilsStore } from "@/stores/utils";
const utilsStore = useUtilsStore();
</script>
