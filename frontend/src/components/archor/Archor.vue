<template>
  <router-link :to="to" v-slot="{ href, navigate, isActive }">
    <a
      :href="href"
      @click="
        () => {
          navigate;
          utilsStore.toggleSideBar();
        }
      "
      class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group"
      :class="[
        isActive
          ? 'text-blue-500 dark:text-blue-400'
          : 'text-gray-900 dark:text-white ',
      ]"
    >
      <v-icon
        :name="icon"
        class="flex-shrink-0 w-5 h-5 transition duration-75"
      />
      <span class="flex-1 ml-3 whitespace-nowrap">{{ name }}</span>
    </a>
  </router-link>
</template>
<script setup>
import { useUtilsStore } from "@/stores/utils";
const utilsStore = useUtilsStore();
const props = defineProps({
  to: {
    type: String,
    default: "/",
  },
  icon: {
    type: String,
  },
  name: {
    type: String,
  },
});
</script>
