<template>
  <card-data title="Clientes" icon="fa-users">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newPerson"> Agregar Cliente </button-add>
    </template>
    <data-table :items="itemsDisplay" :columns="columnas" :options="options">
    </data-table>
  </card-data>
</template>
<script setup>
import { ref } from "vue";

import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";

const columnas = ref([
  { key: "id", label: "ID" },
  { key: "name", label: "Nombre" },
  { key: "surname", label: "Apellido" },
  { key: "city", label: "Ciudad" },
  { key: "createdAt", label: "Creado", date: true },
]);
</script>
