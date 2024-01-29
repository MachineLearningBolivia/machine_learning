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
  { key: "created_at", label: "Fecha de operación", date: true },
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
    router.push({ path: "/update/operations", query: { id: action.id } });
  }
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <card-data title="Operaciones" icon="fa-book">
    <template v-slot:filters>
      <div class="pb-4">
        <Search v-model="searchQuery" />
      </div>
      <button-add to="/new/operations"> Agregar Operación </button-add>
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
