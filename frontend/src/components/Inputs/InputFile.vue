<script setup>
import { importCategoriesRequest } from "@/api/excel";
import { ref } from "vue";
import { toast } from "vue-sonner";

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  file: {
    type: String,
    required: true,
  },
});

// const file = ref(null);
// file.value = props.file;

function handleFileUpload(event) {
  props.file = event.target.files[0];
}

async function handleSubmit(event) {
  event.preventDefault();
  const formData = new FormData();
  formData.append("import_file", props.file);
  try {
    await importCategoriesRequest(formData);
    // items.value = [];
    // loadData();
    toast.success("Categorías importadas");
  } catch (error) {
    toast.error("Error al importar, elija un archivo");
  }
}
</script>

<template>
  <form class="max-w-lg mx-auto" @submit="handleSubmit">
    <div class="flex flex-wrap items-center">
      <div class="w-full lg:w-6/12 mx-2 mb-2 lg:mb-0">
        <label
          class="block text-sm font-medium text-gray-900 dark:text-white"
          for="file"
          >Importar desde un archivo Excel</label
        >
        <input
          :id="id"
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
</template>
