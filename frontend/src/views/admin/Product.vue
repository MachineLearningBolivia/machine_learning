<template>
  <card-data title="Productos" icon="fa-cubes">
    <template v-slot:filters>
      <div class="pb-4">
        <Search />
      </div>
      <button-add to="/newProduct"> Agregar Producto </button-add>
    </template>
    <data-table :options=1 :items="itemsDisplay" :columns="columnas" :modelValue="itemsDisplay">
    </data-table>
  </card-data>
</template>
<script setup>

import { getProduct } from "../../../api/product.js"
import CardData from "@/components/Cards/CardData.vue";
import Search from "@/components/Inputs/Search.vue";
import ButtonAdd from "@/components/button/ButtonAdd.vue";
import DataTable from "@/components/Tables/DataTable.vue";

//import { getProduct } from "@/api/product.js";

import { ref, onMounted } from "vue";

const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);

const columnas = ref([
  { key: "id", label: "ID" },
  { key: "name", label: "Nombre" },
  { key: "description", label: "Descripción" },
  { key: "price", label: "Precio"},
  { key: "stock", label: "Cantidad" },
  { key: "slug", label: "Slug" },
  { key: "image", label: "Imagen", image: true},
  { key: "status", label: "Estado" },
  { key: "category", label: "Categoria" },
  { key: "created", label: "Creado" },
  { key: "updated", label: "Subido" },
]);

async function loadData() {
  load.value = true;
  try {
    const res = await getProduct();
    items.value = res.data;
    console.log(res)
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
