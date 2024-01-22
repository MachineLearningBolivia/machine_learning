<script setup>
import { getSalesRequest } from "@/api/sale";
import { ref, onMounted, watch } from "vue";
import { useRouter } from "vue-router";
import { toast } from "vue-sonner";
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";

const router = useRouter();
const items = ref([]);
const itemsDisplay = ref([]);
const searchQuery = ref("");
const load = ref(true);
const columns = ref([
  { key: "id", label: "ID" },
  { key: "quantity", label: "Cantidad" },
  { key: "totalPrice", label: "Precio total" },
  { key: "date", label: "fecha" },
  { key: "product_id", label: "ID producto" },
  { key: "person_id", label: "ID persona" },
]);
const options = ref([{ id: "update", name: "Actualizar", icon: "fa-plus" }]);

async function loadData() {
  load.value = true;
  try {
    const res = await getSalesRequest();
    items.value = res.data;
    itemsDisplay.value = items.value.data;
    load.value = false;
  } catch (error) {
    toast.error("Error al cargar datos");
  }
}
watch(searchQuery, () => {
  searchItems();
});

function searchItems() {
  const filteredItems = items.value.data.filter(
    (item) =>
      item.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      item.description.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
  itemsDisplay.value = filteredItems;
}

async function action(action) {
  if (action.action === "update") {
    router.push({ path: "updateSale", query: { id: action.id } });
  }
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <card-data title="Ventas" icon="fa-chart-bar">
    <template v-slot:filters>
      <div class="pb-4">
        <Search v-model="searchQuery" />
      </div>
      <button-add to="/newSale">Agregar venta</button-add>
    </template>
    <DataTable
      :items="itemsDisplay"
      :columns="columns"
      :options="options"
      :modelValue="itemsDisplay"
      @action="action"
    />
  </card-data>
</template>
