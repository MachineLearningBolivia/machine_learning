<script setup>
import { getOperationsRequest } from "@/api/operation";
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
  { key: "name", label: "Nombre" },
  { key: "description", label: "Descripción" },
  { key: "user", label: "ID Usuario" },
  { key: "box_id", label: "ID Caja" },
  { key: "operation_type_id", label: "ID Tipo de operación" },
  { key: "check", label: "Check" },
  { key: "created_at", label: "Fecha de operación" },
]);
const options = ref([{ id: "update", name: "Actualizar", icon: "fa-plus" }]);

async function loadData() {
  load.value = true;
  try {
    const res = await getOperationsRequest();
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
    router.push({ path: "updateOperation", query: { id: action.id } });
  }
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <card-data title="Operaciones" icon="fa-clipboard-list">
    <template v-slot:filters>
      <div class="pb-4">
        <Search v-model="searchQuery" />
      </div>
      <button-add to="/newOperation"> Agregar Operación </button-add>
    </template>
    <data-table
      :items="itemsDisplay"
      :columns="columns"
      :options="options"
      :modelValue="itemsDisplay"
      @action="action"
    >
    </data-table>
  </card-data>
</template>
