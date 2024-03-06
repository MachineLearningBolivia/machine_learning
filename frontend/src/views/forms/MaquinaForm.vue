<script setup>
import {
  createMaquinaRequest,
  getMaquinaRequest,
  getMaquinasRequest
} from "@/api/maquina";
import { getCategoriasRequest } from "@/api/categoria";
import { createSlug } from "@/utils/index";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Form.vue";
import Input from "@/components/inputs/Input.vue";
import Select from "@/components/inputs/Select.vue";
import Checkbox from "@/components/inputs/Checkbox.vue";

const route = useRoute();
const router = useRouter();
const categorias = ref([]);
const formData = reactive({
  name: "",
  description: "",
  fichaTecnica: "",
  capacidad: "",
  image: "",
  categoria_id: "",
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  description: {
    required: helpers.withMessage("Se requiere la descripción", required),
  },
  fichaTecnica: {
    required: helpers.withMessage("Se requiere una ficha tecnica", required),
  },
  capacidad: {
    required: helpers.withMessage("Se requiere una capacidad", required),
  },
  image: {
    required: helpers.withMessage("Se requiere una imagen", required),
  },
  categoria_id: {
    required: helpers.withMessage("Se requiere una categoría", required),
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
        await createMaquinaRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Maquina guardada correctamente");
      } else {
        await getMaquinasRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Maquina actualizada correctamente");
      }
      router.push("/maquinaria");
    } catch (error) {
      toast.error(
        "Error al añadir la maquina, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  try {
    const res = await getCategoriasRequest();
    categorias.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar categorías");
  }
  if (route.query.id) {
    try {
      const res = await getMaquinaRequest(route.query.id);
      Object.assign(formData, res.data.maquina);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/maquinaria");
    }
  }
});
</script>

<template>
  <Forms
    title="Información de producto"
    icon="fa-shopping-cart"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la Maquina
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
        <Input
          id="fichaTecnica"
          labelText="Ficha Tecnica"
          v-model="v$.fichaTecnica.$model"
          :errors="v$.fichaTecnica.$errors"
          type="url"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="capacidad"
          labelText="Capacidad"
          v-model="v$.capacidad.$model"
          :errors="v$.capacidad.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input
          id="image"
          labelText="Imagen"
          v-model="v$.image.$model"
          :errors="v$.image.$errors"
          type="url"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="categoria_id"
          labelText="Categoría"
          v-model="v$.categoria_id.$model"
          :errors="v$.categoria_id.$errors"
          :options="categorias"
        />
      </div>
    </div>
  </Forms>
</template>
