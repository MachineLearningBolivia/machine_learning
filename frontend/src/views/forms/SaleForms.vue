<script setup>
import {
  createSaleRequest,
  getSaleRequest,
  updateSaleRequest,
} from "@/api/sale";
import { getPeopleRequest } from "@/api/person";
import { getProductsRequest } from "@/api/product";
import { createSlug } from "@/utils/index";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Forms.vue";
import Input from "@/components/inputs/Input.vue";
import Select from "@/components/inputs/Select.vue";

const route = useRoute();
const router = useRouter();
const people = ref([]);
const products = ref([]);
const formData = reactive({
  quantity: "",
  totalPrice: "",
  date: "",
  person_id: "",
  product_id: "",
});
const rules = {
  quantity: {
    required: helpers.withMessage("Se requiere la cantidad", required),
  },
  totalPrice: {
    required: helpers.withMessage("Se requiere el precio total", required),
  },
  date: { required: helpers.withMessage("Se requiere la fecha", required) },
  person_id: {
    required: helpers.withMessage("Se requiere la persona", required),
  },
  product_id: {
    required: helpers.withMessage("Se requiere el producto", required),
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
        const generateSlug =
          formData.person_id + " " + formData.product_id + " " + formData.date;
        formData.slug = createSlug(generateSlug);
        await createSaleRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Venta guardada correctamente");
      } else {
        await updateSaleRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Venta actualizada correctamente");
      }
      router.push("/sale");
    } catch (error) {
      toast.error(
        "Error al añadir la venta, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  try {
    const res = await getPeopleRequest();
    people.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar datos");
  }
  try {
    const res = await getProductsRequest();
    products.value = res.data.data;
  } catch (error) {
    toast.error("Error al cargar datos");
  }
  if (route.query.id) {
    try {
      const res = await getSaleRequest(route.query.id);
      Object.assign(formData, res.data.sale);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/sale");
    }
  }
});
</script>

<template>
  <Forms
    title="Información de producto"
    icon="fa-chart-line"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos de la venta
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="quantity"
          labelText="Cantidad"
          v-model="v$.quantity.$model"
          :errors="v$.quantity.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="totalPrice"
          labelText="Precio total"
          v-model="v$.totalPrice.$model"
          :errors="v$.totalPrice.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="date"
          labelText="Fecha"
          v-model="v$.date.$model"
          :errors="v$.date.$errors"
          type="date"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="person_id"
          labelText="Usuario"
          v-model="v$.person_id.$model"
          :errors="v$.person_id.$errors"
          :options="people"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select
          id="product_id"
          labelText="Producto"
          v-model="v$.product_id.$model"
          :errors="v$.product_id.$errors"
          :options="products"
        />
      </div>
    </div>
  </Forms>
</template>
