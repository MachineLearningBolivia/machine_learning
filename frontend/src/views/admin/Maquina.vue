<script setup>
import { getMaquinasRequest, importMaquinasRequest } from "@/api/maquina";
import { ref, onMounted, watch } from "vue";
import { useRouter } from "vue-router";
import { toast } from "vue-sonner";
import CardData from "@/components/cards/CardData.vue";
import Search from "@/components/inputs/Search.vue";
import ButtonAdd from "@/components/buttons/ButtonAdd.vue";
import DataTable from "@/components/tables/DataTable.vue";

const router = useRouter();
const file = ref(null);
const items = ref([]);
const itemsDisplay = ref([]);
const searchQuery = ref("");
const load = ref(true);
const columns = ref([
  { key: "id", label: "ID" },
  { key: "name", label: "Nombre" },
  { key: "description", label: "Descripción" },
  { key: "fichaTecnica", label: "Ficha tecnica" },
  { key: "capacidad", label: "Capacidad" },
  { key: "image", label: "Imagen", image: true },
]);
const options = ref([{ id: "update", name: "Actualizar", icon: "fa-plus" }]);

async function loadData() {
  load.value = true;
  try {
    const res = await getMaquinasRequest();
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
    router.push({ path: "/update/maquinaria", query: { id: action.id } });
  }
}

function handleFileUpload(event) {
  file.value = event.target.files[0];
}

async function handleSubmit(event) {
  event.preventDefault();
  const formData = new FormData();
  formData.append("import_file", file.value);
  try {
    await importMaquinasRequest(formData);
    items.value = [];
    loadData();
    toast.success("Maquinas importadas");
  } catch (error) {
    toast.error("Error al importar, elija un archivo");
  }
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <card-data title="Maquinas" icon="fa-shopping-cart">
    <template v-slot:filters>
      <div class="pb-4">
        <Search v-model="searchQuery" />
      </div>

      <form class="max-w-lg mx-auto" @submit="handleSubmit">
        <div class="flex flex-wrap items-center">
          <div class="w-full lg:w-6/12 mx-2 mb-2 lg:mb-0">
            <label
              class="block text-sm font-medium text-gray-900 dark:text-white"
              for="file"
              >Importar desde un archivo Excel</label
            >
            <input
              id="file"
              class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              @change="handleFileUpload"
              accept=".xlsx, .csv"
              type="file"
            />
          </div>
          <div class="w-full lg:w-4/12 mx-2">
            <button
              class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
              type="submit"
            >
              <v-icon name="fa-file-import" class="mr-1" />
              Importar
            </button>
          </div>
        </div>
      </form>

      <button-add to="/new/maquinaria"> Agregar Maquina </button-add>
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