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
        <Input id="name" labelText="Nombre" type="text" v-model="modelProduct.name"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="description" labelText="Descripción" type="text" v-model="modelProduct.description" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="price" labelText="Precio" type="number" v-model="modelProduct.price" />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="stock" labelText="Cantidad" type="number" v-model="modelProduct.stock" />
      </div>
      <!-- <div class="w-full lg:w-full px-4">
        <Input id="image" labelText="Imagen" type="file" />
      </div> -->
      <div class="w-full lg:w-6/12 px-4">
        <Select id="category_id" labelText="Categoria" v-model="modelProduct.category_id"/>
          
    <Select
      id="mySelect" 
      labelText="Etiqueta del selector" 
      :modelValue="selectedValue"
      :errors="selectErrors"
      :options="selectOptions"
      name="name"
      :disabled="isDisabled"
      @update:modelValue="updateSelectedValue"
    />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Checkbox id="status" labelText="Disponible" v-model="modelProduct.status"/>
      </div>
    </div>
  </Forms>
</template>
<script setup>
import { toast } from "vue-sonner";
import { ref } from 'vue';
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import Select from "@/components/Inputs/Select.vue";
import Checkbox from "@/components/Inputs/Checkbox.vue";

import { postProduct } from "../../../api/product.js";

const modelProduct = ref([{
   name: '',
   description: '',
   price: '',
   stock: '',
   slug: '',
   image: '',
   status: '',
   category_id: ''
}]);


async function handleSubmit() {

  try {
const productData = {
  name: 'Nombre del producto',
  description: 'Descripción del producto',
  price: 29.99,
  stock: 100,
  slug: 'slug-del-producto',
  image: 'url-de-la-imagen.jpg',
  status: true,
  category_id: 1
};
    console.log(productData);
    const res = await postProduct({ json: JSON.stringify(productData) });
    console.log(res);
    alert(res.data.message);
    // Limpia el formulario después de enviar los datos
    modelProduct.value = {
      name: '',
      description: '',
      price: '',
      stock: '',
      slug: '',
      image: '',
      status: '',
      category_id: ''
    };
    toast.success("Información actualizada correctamente");
  } catch (error) {
    console.error("Error al enviar el producto:", error);
    alert("Error al enviar el producto. Por favor, verifica los datos e intenta nuevamente.");
  }
}
async function saveProduct() {
}
</script>
