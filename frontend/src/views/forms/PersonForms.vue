<template>
  <Forms
    title="Información del cliente"
    icon="fa-user"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del cliente
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input id="name" labelText="Nombre" type="text" v-model="modelPeople.name" placeholder="Nombre del cliente"/>
      </div>
      <div class="w-full lg:w-full px-4">
        <Input id="city" labelText="Ciudad" type="text" v-model="modelPeople.city" placeholder="Ciudad del cliente"/>
      </div>
      <div class="w-full lg:w-full px-4">
        <Input id="Country" labelText="País" type="text" v-model="modelPeople.country" placeholder="Pais del cliente"/>
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";
import { ref, onMounted } from 'vue';
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import { postPeople } from "../../../api/people"
const modelPeople = {
   name: '',
   country: '',
   city: '',
};
async function handleSubmit() {
  try {
    const res = await postPeople({ json: JSON.stringify(modelPeople) });
    modelPeople.value = {
      name: '',
      country: '',
      country: '',
    };
    toast.success("Informacion actualizada correctamente");
  } catch (error) {
    toast.error("Error al añadir al cliente, por favor verifique que los datos esten correctos")
  }
}
</script>