<template>
  <card-data title="Operaciones" icon="fa-clipboard-list">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newOperation"> Agregar Operación </button-add>
    </template>
    <data-table :items="itemsDisplay" :columns="columnas" :options=1 :modelValue="itemsDisplay">
    </data-table>
  </card-data>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import DataTable from "@/components/Tables/DataTable.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
// get request for opartions
import { getOperation } from "../../../api/operation.js"
import { ref, onMounted } from "vue";

const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);

const columnas = ref([
  { key: "name", label: "Nombre" },
  { key: "description", label: "Descripción" },
  { key: "user", label: "Usuario"},
  { key: "box_id", label: "Caja" },
  { key: "operation_type_id", label: "Tipo de operacion" }
]);

async function loadData() {
  load.value = true;
  try {
    const res = await getOperation();
    items.value = res.data;
    console.log(res)
    itemsDisplay.value = items.value.data;
    load.value = false;
    //console.log(items.value);
    //console.log(items.value.data[3]);
    console.log(itemsDisplay.value);
    //console.log(items.value[0]);
  } catch (error) {
    toast.error("Error al cargar datos");
  }
}


onMounted(() => {
  loadData();
});

</script>
