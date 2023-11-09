<template>
  <div class="flex flex-wrap mt-4">
    <div class="w-full mb-12 px-4">
      <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white dark:bg-gray-800"
      >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="font-semibold text-lg text-gray-800 dark:text-white">
                {{ title }}
                <v-icon scale="1.5" :name="icon" />
              </h3>
            </div>
          </div>
        </div>
        <div class="w-full px-4 flex flex-wrap gap-2 justify-between">
          <slot name="filters"> </slot>
        </div>
        <slot> </slot>
      </div>
    </div>
  </div>
</template>
<script setup>
// import { ref } from "vue";
const props = defineProps({
  title: {
    type: String,
    default: "Titulo",
  },
  icon: {
    type: String,
    default: "fa-home",
  },
});
</script>
