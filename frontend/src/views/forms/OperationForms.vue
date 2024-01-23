<script setup>
import {
  createOperationRequest,
  getOperationRequest,
  updateOperationRequest,
} from "@/api/operation";
import { getUsersRequest } from "@/api/user";
import { getBoxesRequest } from "@/api/box";
import { getOperationTypesRequest } from "@/api/operationType";
import { createSlug } from "@/utils/index";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Forms.vue";
import Input from "@/components/inputs/Input.vue";
import Select from "@/components/inputs/Select.vue";
import Checkbox from "@/components/inputs/Checkbox.vue";
import { getOperationTypeRequest } from "../../api/operationType";

const route = useRoute();
const router = useRouter();
const users = ref([]);
const boxes = ref([]);
const operationTypes = ref([]);
const formData = reactive({
  name: "",
  description: "",
  user: "",
  box_id: "",
  operation_type_id: "",
  check: false,
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  description: {
    required: helpers.withMessage("Se requiere la descripción", required),
  },
  user: {
    required: helpers.withMessage("Se requiere usuario", required),
  },
  box_id: {
    required: helpers.withMessage("Se requiere caja", required),
  },
  operation_type_id: {
    required: helpers.withMessage("Se requiere tipo de operación", required),
  },
  check: {
    required: helpers.withMessage("Se requiere el estado", required),
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
        formData.slug = createSlug(formData.name);
        await createOperationRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Operación guardada correctamente");
      } else {
        await updateOperationRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Operación actualizada correctamente");
      }
      router.push("/operation");
    } catch (error) {
      toast.error(
        "Error al añadir la operación, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  try {
    const res = await getUsersRequest();
    users.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar categorías");
  }
  try {
    const res = await getBoxesRequest();
    boxes.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar categorías");
  }
  try {
    const res = await getOperationTypesRequest();
    operationTypes.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar categorías");
  }
  if (route.query.id) {
    try {
      const res = await getOperationRequest(route.query.id);
      console.log(res.data.operation);
      Object.assign(formData, res.data.operation);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/operation");
    }
  }
});
</script>

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
        <Input
          id="name"
          labelText="Nombre"
          v-model="v$.name.$model"
          :errors="v$.name.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="description"
          labelText="Descripción"
          v-model="v$.description.$model"
          :errors="v$.description.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="user"
          labelText="Usuario"
          v-model="v$.user.$model"
          :errors="v$.user.$errors"
          :options="users"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="box_id"
          labelText="Caja"
          v-model="v$.box_id.$model"
          :errors="v$.box_id.$errors"
          :options="boxes"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="operation_type_id"
          labelText="Tipo de operación"
          v-model="v$.operation_type_id.$model"
          :errors="v$.operation_type_id.$errors"
          :options="operationTypes"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Checkbox
          id="check"
          labelText="Check"
          v-model="v$.check.$model"
          :errors="v$.check.$errors"
        />
      </div>
    </div>
  </Forms>
</template>
