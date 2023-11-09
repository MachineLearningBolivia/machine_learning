<template>
  <Forms
    title="Información de producto"
    icon="fa-list-alt"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del producto
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-6/12 px-4">
        <Input id="name" labelText="Nombre" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="description" labelText="Descripción" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="price" labelText="Precio" type="number" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="stock" labelText="Cantidad" type="number" />
      </div>
      <!-- <div class="w-full lg:w-full px-4">
        <Input id="image" labelText="Imagen" type="file" />
      </div> -->
      <div class="w-full lg:w-6/12 px-4">
        <Select id="category_id" labelText="Categoria" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Checkbox id="status" labelText="Disponible" />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";

import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import Select from "@/components/Inputs/Select.vue";
import Checkbox from "@/components/Inputs/Checkbox.vue";

async function handleSubmit() {
  toast.success("Informacion actualizada correctamente");
}
</script>
