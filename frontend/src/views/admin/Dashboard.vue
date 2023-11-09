<template>
  <div>
    <!-- Card stats -->
    <div class="flex flex-wrap mb-4">
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="PEDIDOS"
          :statTitle="entrie"
          statDescripiron="Pedidos registrados hoy"
          statIconName="fa-shopping-bag"
          statIconColor="bg-pink-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="VENTAS"
          :statTitle="exit"
          statDescripiron="Ventas registradas hoy"
          statIconName="fa-shopping-cart"
          statIconColor="bg-emerald-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="OPERACIONES"
          :statTitle="visit"
          statDescripiron="Operaciones registradas hoy"
          statIconName="fa-clipboard-list"
          statIconColor="bg-orange-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="CLIENTES"
          :statTitle="employee"
          statDescripiron="Clientes regitrados"
          statIconName="fa-users"
          statIconColor="bg-red-500"
        />
      </div>
    </div>

    <!-- Tabla Productos -->
    <div class="flex flex-wrap mt-8 mb-4 mx-4 rounded-md shadow-xl">
      <div class="w-full p-4 border-b">
        <h6 class="text-center text-xl font-semibold">Últimos vendidos</h6>
      </div>
      <table class="w-full text-left text-gray-200">
        <thead class="text-xs text-black uppercase border-b">
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Nombre</th>
          <th class="px-4 py-3">Descripción</th>
          <th class="px-4 py-3">Cantidad</th>
          <th class="px-4 py-3">Precio (Bs.)</th>
        </thead>
        <tbody>
          <tr
            v-for="product in products"
            :key="product.id"
            class="text-xs border-b text-black hover:bg-gray-100"
          >
            <td class="px-4 py-3">
              <span class="rounded-full py-1 px-3"> {{ product.id }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ product.name }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3">
                {{ product.description }}</span
              >
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ product.stock }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ product.price }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Tabla Clientes -->
    <div class="flex flex-wrap mt-8 mb-4 mx-4 rounded-md shadow-xl">
      <div class="w-full p-4 border-b">
        <h6 class="text-center text-xl font-semibold">Últimos Registrados</h6>
      </div>
      <table class="w-full text-left text-gray-200">
        <thead class="text-xs text-black uppercase border-b">
          <th class="px-4 py-3">ID</th>
          <th class="px-4 py-3">Nombre</th>
          <th class="px-4 py-3">Apellidos</th>
          <th class="px-4 py-3">Ciudad</th>
          <th class="px-4 py-3">Pedido</th>
          <th class="px-4 py-3">Compra</th>
        </thead>
        <tbody>
          <tr
            v-for="person in people"
            :key="person.id"
            class="text-xs border-b text-black hover:bg-gray-100"
          >
            <td class="px-4 py-3">
              <span class="rounded-full py-1 px-3"> {{ person.id }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ person.name }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ person.surname }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ person.city }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ person.order }}</span>
            </td>
            <td class="px-4 py-4">
              <span class="rounded-full py-1 px-3"> {{ person.purchase }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
import CardStats from "@/components/Cards/CardStats.vue";

const products = [
  {
    id: 1,
    name: "Product 1",
    description: "Description",
    stock: 55,
    price: 99,
  },
  {
    id: 2,
    name: "Product 2",
    description: "Description",
    stock: 15,
    price: 80,
  },
  {
    id: 3,
    name: "Product 3",
    description: "Description",
    stock: 25,
    price: 10,
  },
  {
    id: 4,
    name: "Product 4",
    description: "Description",
    stock: 6,
    price: 15,
  },
  {
    id: 5,
    name: "Product 5",
    description: "Description",
    stock: 12,
    price: 30,
  },
];

const people = [
  {
    id: 1,
    name: "Name",
    surname: "Surname",
    city: "City",
    order: "Product name",
    purchase: "Product name",
  },
  {
    id: 2,
    name: "Name",
    surname: "Surname",
    city: "City",
    order: "Product name",
    purchase: "",
  },
  {
    id: 3,
    name: "Name",
    surname: "Surname",
    city: "City",
    order: "Product name",
    purchase: "Product name",
  },
];
</script>
