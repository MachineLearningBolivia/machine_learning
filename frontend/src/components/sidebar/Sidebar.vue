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
          <ArchorAccordion name="Usuarios" icon="fa-users">
            <li>
              <Archor to="/employee" icon="fa-user-tie" name="Empleados" />
              <Archor to="/external" icon="fa-user" name="Externos" />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <Archor to="/visit" icon="fa-user-edit" name="Visitas" />
        </li>
        <li>
          <ArchorAccordion name="Tarjetas" icon="fa-address-card">
            <li>
              <Archor
                to="/typecard"
                icon="fa-address-book"
                name="Tipos de tarjetas"
              />
              <Archor to="/card" icon="fa-address-card" name="Tarjetas" />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <ArchorAccordion name="Entradas y salidas" icon="fa-calendar-alt">
            <li>
              <Archor to="/entry" icon="fa-sign-in-alt" name="Entradas" />
              <Archor to="/exit" icon="fa-sign-out-alt" name="Salidas" />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <ArchorAccordion name="Horarios" icon="fa-calendar-alt">
            <li>
              <Archor to="/timetable" icon="fa-calendar-alt" name="Horarios" />
              <Archor to="/assign" icon="fa-clock" name="Asignar Horarios" />
              <Archor to="/vacation" icon="fa-calendar-day" name="Vacaciones" />
              <Archor
                to="/inactive"
                icon="fa-calendar-times"
                name="Inactivos"
              />
            </li>
          </ArchorAccordion>
        </li>
        <li>
          <ArchorAccordion name="Configuración" icon="co-settings">
            <li>
              <Archor to="/role" icon="fa-users" name="Roles de empleados" />
              <Archor to="/turnstile" icon="gi-turnstile" name="Molinetes" />
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
