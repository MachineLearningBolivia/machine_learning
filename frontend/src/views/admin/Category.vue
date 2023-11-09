<template>
  <card-data title="Categorias" icon="fa-list-alt">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newCategory"> Agregar Categoria </button-add>
    </template>
    <data-table :items="itemsDisplay" :columns="columnas" :options="options">
    </data-table>
  </card-data>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";
</script>
