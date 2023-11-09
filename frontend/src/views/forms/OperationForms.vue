<template>
  <Forms
    title="Información de la operación"
    icon="fa-clipboard-list"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la operación
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-6/12 px-4">
        <Input id="name" labelText="Nombre" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select id="operation_type_id" labelText="Tipo de operación" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select id="box_id" labelText="Caja" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select id="user" labelText="Usuario" />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";

import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import Select from "@/components/Inputs/Select.vue";

async function handleSubmit() {
  toast.success("Informacion actualizada correctamente");
}
</script>
