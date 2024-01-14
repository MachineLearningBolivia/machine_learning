<template>
  <Forms
    title="Información de categoría"
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
<script setup>
import { postCategory, getCategory } from "@/api/category";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";

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

async function handleSubmit(event) {
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      if (!route.query.id) {
        formData.slug = createSlug(formData.name);
        await postCategory(formData);
        toast.success("Categoría guardada correctamente");
      } else {
        toast.success("Categoría actualizada correctamente");
      }
      router.push("/category");
    } catch (error) {
      toast.error(
        "Error al añadir la categoría, por favor verifique que los datos estén correctos"
      );
    }
  }
}

function createSlug(text) {
  let spaces = text.replace(/\s+/g, "-");
  let accents = spaces.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  return accents.toLowerCase();
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getCategory(route.query.id);
      Object.assign(formData, res.data.category);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/category");
    }
  }
});
</script>
