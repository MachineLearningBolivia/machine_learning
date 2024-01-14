<template>
  <Forms
    title="Información de producto"
    icon="fa-list-alt"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del producto
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
          id="price"
          labelText="Precio"
          v-model="v$.price.$model"
          :errors="v$.price.$errors"
          type="number"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="stock"
          labelText="Cantidad"
          v-model="v$.stock.$model"
          :errors="v$.stock.$errors"
          type="number"
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
          id="category_id"
          labelText="Categoría"
          v-model="v$.category_id.$model"
          :errors="v$.category_id.$errors"
          :options="categories"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Checkbox
          id="status"
          labelText="Disponible"
          v-model="v$.status.$model"
        />
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { postProduct, getProduct } from "@/api/product.js";
import { getCategories } from "@/api/category.js";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import Select from "@/components/Inputs/Select.vue";
import Checkbox from "@/components/Inputs/Checkbox.vue";

const route = useRoute();
const router = useRouter();
const categories = ref([]);
const formData = reactive({
  name: "",
  description: "",
  price: "",
  stock: "",
  image: "",
  status: false,
  category_id: "",
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  description: {
    required: helpers.withMessage("Se requiere la descripción", required),
  },
  price: {
    required: helpers.withMessage("Se requiere el precio", required),
  },
  stock: {
    required: helpers.withMessage("Se requiere el stock", required),
  },
  image: {
    required: helpers.withMessage("Se requiere una imagen", required),
  },
  status: {
    required: helpers.withMessage("Se requiere el estado", required),
  },
  category_id: {
    required: helpers.withMessage("Se requiere una categoría", required),
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
        await postProduct(formData);
        toast.success("Producto guardada correctamente");
      } else {
        toast.success("Producto actualizada correctamente");
      }
      router.push("/product");
    } catch (error) {
      toast.error(
        "Error al añadir la producto, por favor verifique que los datos estén correctos"
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
  try {
    const res = await getCategories();
    categories.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar categorías");
  }
  if (route.query.id) {
    try {
      const res = await getProduct(route.query.id);
      Object.assign(formData, res.data.product);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/product");
    }
  }
});
</script>
