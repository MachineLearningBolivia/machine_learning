<template>
  <card-data title="Cajas" icon="fa-box">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newBox"> Agregar Caja </button-add>
    </template>
  </card-data>
  <data-table :items="itemsDisplay" :columns="columnas" :options="options">
  </data-table>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import DataTable from "@/components/Tables/DataTable.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
</script>
