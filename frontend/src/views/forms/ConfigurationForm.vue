<script setup>
import {
  createConfigurationRequest,
  getConfigurationRequest,
  updateConfigurationRequest,
} from "@/api/configuration";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Forms.vue";
import Input from "@/components/inputs/Input.vue";

const route = useRoute();
const router = useRouter();
const formData = reactive({
  name: "",
  value: "",
  description: "",
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  value: {
    required: helpers.withMessage("Se requiere un valor", required),
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
        await createConfigurationRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Configuración guardada correctamente");
      } else {
        await updateConfigurationRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Configuración actualizada correctamente");
      }
      router.push("/configurations");
    } catch (error) {
      toast.error(
        "Error al añadir la Configuración, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getConfigurationRequest(route.query.id);
      Object.assign(formData, res.data.configuration);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/configurations");
    }
  }
});
</script>

<template>
  <Forms
    title="Información de la operación"
    icon="fa-list-alt"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la categoría
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
