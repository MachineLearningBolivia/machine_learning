<template>
  <card-data title="Clientes" icon="fa-users">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newPerson"> Agregar Cliente </button-add>
    </template>
  </card-data>
  <data-table :items="itemsDisplay" :columns="columnas" :options="options">
  </data-table>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";
</script>
