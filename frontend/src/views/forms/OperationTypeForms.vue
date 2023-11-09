<template>
  <Forms
    title="Información de tipo de operación"
    icon="fa-regular-edit"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del tipo de operación
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input id="name" labelText="Nombre" type="text" />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input id="description" labelText="Descripción" type="text" />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";

import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";

async function handleSubmit() {
  toast.success("Informacion actualizada correctamente");
}
</script>
