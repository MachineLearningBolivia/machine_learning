<template>
  <card-data title="Ventas" icon="fa-chart-bar">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
    </template>
  </card-data>
  <data-table :items="itemsDisplay" :columns="columnas" :options="options">
  </data-table>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import DataTable from "@/components/Tables/DataTable.vue";
</script>
