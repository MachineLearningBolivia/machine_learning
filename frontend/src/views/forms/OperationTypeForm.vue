<script setup>
import {
  createOperationTypeRequest,
  getOperationTypeRequest,
  updateOperationTypeRequest,
} from "@/api/operationType";
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
  slug: {},
};
const v$ = useVuelidate(rules, formData);
const errors = ref([]);

async function handleSubmit() {
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      if (!route.query.id) {
        await createOperationTypeRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Categoría guardada correctamente");
      } else {
        await updateOperationTypeRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Categoría actualizada correctamente");
      }
      router.push("/operations-type");
    } catch (error) {
      toast.error(
        "Error al añadir la categoría, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getOperationTypeRequest(route.query.id);
      Object.assign(formData, res.data.operationType);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/operations-type");
    }
  }
});
</script>

<template>
  <Forms
    title="Información de tipo de operación"
    icon="fa-clipboard-list"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del tipo de operación
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
