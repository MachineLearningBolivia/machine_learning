<script setup>
import { createBoxRequest, getBoxRequest, updateBoxRequest } from "@/api/box";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Form.vue";
import Input from "@/components/inputs/Input.vue";

const route = useRoute();
const router = useRouter();
const formData = reactive({
  name: "",
  description: "",
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  description: {
    required: helpers.withMessage("Se requiere la descripción", required),
  },
};
const v$ = useVuelidate(rules, formData);
const errors = ref([]);

async function handleSubmit() {
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      if (!route.query.id) {
        await createBoxRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Caja guardada correctamente");
      } else {
        await updateBoxRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Caja actualizada correctamente");
      }
      router.push("/boxes");
    } catch (error) {
      toast.error(
        "Error al añadir la producto, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getBoxRequest(route.query.id);
      Object.assign(formData, res.data.box);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/boxes");
    }
  }
});
</script>

<template>
  <Forms
    title="Información de la caja"
    icon="fa-box"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la caja
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input
          id="name"
          labelText="Nombre"
          v-model="v$.name.$model"
          :errors="v$.name.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input
          id="description"
          labelText="Descripción"
          v-model="v$.description.$model"
          :errors="v$.description.$errors"
          type="text"
        />
      </div>
    </div>
  </Forms>
</template>
