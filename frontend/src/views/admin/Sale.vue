<template>
  <card-data title="Ventas" icon="fa-chart-bar">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
    </template>
    <data-table :items="itemsDisplay" :columns="columnas" :options=1 :modelValue="itemsDisplay">
    </data-table>
  </card-data>
</template>
<script setup>
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import DataTable from "@/components/Tables/DataTable.vue";
import { getSale } from "../../../api/sale"
import { ref, onMounted } from "vue";

const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);

const columnas = ref([
  { key: "quantity", label: "Cantidad" },
  { key: "totalPrice", label: "Precio total" },
  { key: "date", label: "fecha" },
  { key: "slug", label: "slug" },
  { key: "product_id", label: "ID producto" },
  { key: "person_id", label: "ID persona" }
]);

async function loadData() {
  load.value = true;
  try {
    const res = await getSale();
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
