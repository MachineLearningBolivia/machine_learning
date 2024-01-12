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
        <Input id="name" labelText="Nombre" type="text" v-model="modelProduct.name" placeholder="Nombre del producto"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="slug" labelText="sluggg" type="text" v-model="modelProduct.slug" placeholder="slug del producto"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="description" labelText="Descripción" type="text" v-model="modelProduct.description" placeholder="Descripcion del producto"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="price" labelText="Precio" type="number" v-model="modelProduct.price" placeholder="Precio del producto"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input id="stock" labelText="Cantidad" type="number" v-model="modelProduct.stock" placeholder="Cantidad del producto"/>
      </div>
      <div class="w-full lg:w-full px-4">
        <Input id="image" v-model="modelProduct.image" labelText="Imagen" type="url" placeholder="Link de la imagen del producto"/>
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Select 
          id="category_id" 
          labelText="Categoria" 
          v-model="modelProduct.category_id"
          :modelValue="selectedValue"
          :errors="selectErrors"
          :options="itemsDisplay"
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
import { ref, onMounted } from 'vue';
import Forms from "@/components/Cards/Forms.vue";
import Input from "@/components/Inputs/Input.vue";
import Select from "@/components/Inputs/Select.vue";
import Checkbox from "@/components/Inputs/Checkbox.vue";

import { postProduct } from "@/api/product.js";
import { getCategory  } from "@/api/category.js";

const modelProduct = {
   name: '',
   description: '',
   price: ``,
   stock: ``,
   slug: '',
   image: '',
   status: false,
   category_id: 0
};
//Opciones para el campo selecte
const isDisabled = false;
const selectedValue = ''; 
// opciones para get category
const items = ref([]);
const load = ref(true);
const itemsDisplay = ref([]);
async function generarSlug() {
      // Función para generar el slug a partir del nombre del producto
      console.log("holaaaaaaaa");
      modelProduct.slug = modelProduct.value[0].name;
      /*
        .toLowerCase() // Convertir a minúsculas
        .replace(/\s+/g, '-') // Reemplazar espacios con guiones
        .replace(/[^a-z0-9-]/g, ''); // Quitar caracteres especiales
        */
      console.log(modelProduct.value[0].name);
    }

// funcion para el envio de post
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
    const res = await postProduct({ json: JSON.stringify(modelProduct) });
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
    toast.error("Error al enviar el producto")
  }
}

</script>
