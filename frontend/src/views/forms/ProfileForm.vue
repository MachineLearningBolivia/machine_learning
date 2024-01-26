<template>
  <Forms
    title="Información de usuario"
    icon="fa-user"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Perfil de usuario
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input
          id="email"
          labelText="Correo electronico"
          type="email"
          disabled
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="first_name" labelText="Nombre/s" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="last_name" labelText="Apellidos" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="ci" labelText="CI" type="text" />
      </div>
    </div>
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Información de contacto
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full px-4">
        <Input id="address" labelText="Dirección" type="text" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="telf" labelText="Teléfono" type="number" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="cel" labelText="Celular" type="number" />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";

import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";

async function handleSubmit() {
  toast.success("Información actualizada correctamente");
}
</script>
