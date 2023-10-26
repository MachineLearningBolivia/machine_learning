<template>
  <Forms title="Cambiar contraseña" icon="fa-key" @handleSubmit="handleSubmit">
    <h6 class="text-gray-400 text-sm mt-3 mb-6 font-bold uppercase">
      Contraseña
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full px-4">
        <Input id="oldPassword" labelText="Contraseña Actual" type="password" />
      </div>
      <div class="w-full px-4">
        <Input id="newPassword" labelText="Nueva contraseña" type="password" />
      </div>
      <div class="w-full px-4">
        <Input
          id="repeatPassword"
          labelText="Repetir nueva contraseña"
          type="password"
        />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";

import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";

async function handleSubmit() {
  toast.success("Contraseña actualizada");
}
</script>
