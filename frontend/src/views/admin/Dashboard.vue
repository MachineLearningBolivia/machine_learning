<template>
  <div>
    <!-- Card stats -->
    <div class="flex flex-wrap mb-4">
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="EMPLEADOS"
          :statTitle="employee"
          statDescripiron="Empleados regitrados"
          statIconName="fa-user-tie"
          statIconColor="bg-red-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="VISITAS"
          :statTitle="visit"
          statDescripiron="Visitas registradas hoy"
          statIconName="fa-address-book"
          statIconColor="bg-orange-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="ENTRADAS"
          :statTitle="entrie"
          statDescripiron="Entradas registradas hoy"
          statIconName="fa-sign-in-alt"
          statIconColor="bg-pink-500"
        />
      </div>
      <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
        <card-stats
          statSubtitle="SALIDAS"
          :statTitle="exit"
          statDescripiron="Salidas registradas hoy"
          statIconName="fa-sign-out-alt"
          statIconColor="bg-emerald-500"
        />
      </div>
    </div>
  </div>
</template>
<script setup>
import CardStats from "@/components/Cards/CardStats.vue";
</script>
