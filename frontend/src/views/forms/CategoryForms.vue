<template>
  <Forms
    title="Información de categoria"
    icon="fa-list-alt"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la categoria
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input id="name" labelText="Nombre" type="text" v-model="modelCategory.name" />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input id="description" labelText="Descripción" type="text" v-model="modelCategory.description" />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";
import { postCategory } from "../../../api/category";
import { ref, onMounted } from 'vue';
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
const modelCategory = {
   name: '',
   description: '',
   slug: 'ostras',
};
const isDisabled = false;
const selectedValue = ''; 
// opciones para get category
const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);

async function handleSubmit() {
  try {
    const res = await postCategory({ json: JSON.stringify(modelCategory) });
    modelCategory.value = {
      name: '',
      description: '',
      slug: '',
    };
    toast.success("Informacion actualizada correctamente");
  } catch (error) {
    console.error("Error al enviar el producto:", error);
    alert("Error al enviar el producto. Por favor, verifica los datos e intenta nuevamente.");
  }
}

</script>
