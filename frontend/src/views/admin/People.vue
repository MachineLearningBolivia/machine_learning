<template>
  <card-data title="Clientes" icon="fa-users">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newPerson"> Agregar Cliente </button-add>
    </template>
    <data-table :items="itemsDisplay" :columns="columnas" :options=1 :modelValue="itemsDisplay">
    </data-table>
  </card-data>
</template>
<script setup>
import { ref, onMounted } from "vue";
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";
import { getPeople } from "../../../api/people";
const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);

const columnas = ref([
  { key: "name", label: "Nombre" },
  { key: "country", label: "Pais" },
  { key: "city", label: "Ciudad" },
]);

async function loadData() {
  load.value = true;
  try {
    const res = await getPeople();
    items.value = res.data;
    //console.log(res)
    itemsDisplay.value = items.value.data;
    load.value = false;
    //console.log(items.value);
    //console.log(items.value.data[3]);
    //console.log(itemsDisplay.value[0]);
    //console.log(items.value[0]);
  } catch (error) {
    toast.error("Error al cargar datos");
  }
}
onMounted(() => {
  loadData();
});
</script>
