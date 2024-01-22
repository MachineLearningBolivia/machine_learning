<script setup>
import Navbar from "@/components/navbar/Navbar.vue";
import Sidebar from "@/components/sidebar/Sidebar.vue";
</script>

<template>
  <Navbar />
  <Sidebar />
  <main>
    <div class="p-4 sm:ml-64">
      <div class="p-4 rounded-lg mt-14">
        <RouterView />
      </div>
    </div>
  </main>
</template>
