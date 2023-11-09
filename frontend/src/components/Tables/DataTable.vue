<template>
  <div class="relative overflow-x-auto sm:rounded-lg m-4">
    <table class="w-full text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <!-- <tr>
          <th v-if="check" class="px-4 py-3">
            <input type="checkbox" @click="change" v-model="checkbox" />
          </th>
          <th
            scope="col"
            v-for="column in columns"
            :key="column.key"
            class="px-4 py-3"
          >
            {{ column.label }}
          </th>
          <th v-if="options.length > 0" class="px-4 py-3">
            <span>Acciones</span>
          </th>
        </tr> -->
      </thead>
      <tbody>
        <tr
          class="text-xs dark:text-white text-gray-800 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          v-for="item in itemsDisplay"
          :key="item.id"
          @click="item.check = !item.check"
        >
          <td v-if="check" class="px-4 py-3">
            <input type="checkbox" v-model="item.check" />
          </td>
          <td class="px-4 py-4" v-for="column in columns" :key="column.key">
            <span v-if="column.color">
              <span
                class="rounded-full py-1 px-3"
                :style="{ backgroundColor: item[column.key] }"
              ></span>
            </span>
            <span v-else-if="column.date">
              {{ dateFormated(item[column.key]) }}
            </span>
            <span v-else-if="column.status" class="flex justify-center">
              <span
                class="rounded-full text-white py-1 px-1"
                :class="[item[column.key] == 1 ? 'bg-green-600' : 'bg-red-600']"
              >
                <v-icon
                  :name="[item[column.key] == 1 ? 'fa-check' : 'fa-times']"
              /></span>
            </span>
            <span v-else-if="column.check" class="flex justify-center">
              <span
                class="rounded-full text-white py-1 px-1"
                :class="[item[column.key] ? 'bg-green-600' : 'bg-red-600']"
              >
                <v-icon :name="[item[column.key] ? 'fa-check' : 'fa-times']"
              /></span>
            </span>
            <span v-else>
              {{ item[column.key] }}
            </span>
          </td>
          <td v-if="options.length > 0" class="px-4 py-2">
            <table-dropdown :options="options" @emit="emit" :id="item.id" />
            <Dropdown>
              <template v-slot:icon>
                <div>
                  <button type="button" class="flex text-sm rounded-full">
                    <v-icon
                      name="co-options"
                      class="w-6 h-6 rounded-full text-gray-600 dark:text-gray-200 p-1"
                    />
                  </button>
                </div>
              </template>
              <div
                class="z-50 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
              >
                <ul class="py-1 text-left" role="none">
                  <li v-for="(option, index) in options" :key="index">
                    <span
                      class="block px-4 py-2 cursor-pointer text-xs text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                      @click="action({ action: option.id, id: item.id })"
                      ><v-icon :name="option.icon" />{{ option.name }}</span
                    >
                  </li>
                </ul>
              </div>
            </Dropdown>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- <nav
      class="flex items-center justify-between pt-4 pb-8"
      aria-label="Table navigation"
    >
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
        >Pagina
        <span class="font-semibold text-gray-900 dark:text-white">{{
          currentPage
        }}</span>
        de
        <span class="font-semibold text-gray-900 dark:text-white">{{
          totalPages
        }}</span></span
      >
      <ul class="inline-flex -space-x-px text-sm h-8">
        <li class="mr-4 flex">
          <label
            class="flex items-center text-gray-500 dark:text-gray-400 px-3 h-8 ml-0"
            for="itemsPerPage"
            >Filas por pagina</label
          >
          <select
            name="itemsPerPage"
            v-model="itemsPerPage"
            class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            <option selected value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </li>
        <li>
          <button
            type="button"
            class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="currentPage--"
            :disabled="currentPage === 1"
          >
            <v-icon name="fa-arrow-left" class="h-4 mt-1" /> Previous
          </button>
        </li>
        <li>
          <button
            type="button"
            @click="currentPage++"
            :disabled="currentPage === totalPages"
            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            Next <v-icon name="fa-arrow-right" class="h-4 mt-1" />
          </button>
        </li>
      </ul>
    </nav> -->
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
// import { fullDateFormat } from "@/utils/index";
// import TableDropdown from "@/components/Dropdown/TableDropdown.vue";
import Dropdown from "@/components/Dropdown/Dropdown.vue";

const emit = defineEmits(["action"]);

const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
  columns: {
    type: Array,
    required: true,
  },
  options: {
    type: Array,
    required: true,
  },
  check: {
    type: Boolean,
    default: false,
  },
});
const checkbox = ref(false);
const currentPage = ref(1);
const itemsPerPage = ref(5);
/*const totalPages = computed(() => {
  return Math.ceil(props.items.length / itemsPerPage.value);
});
const itemsDisplay = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return props.items.slice(start, end);
});
function dateFormated(date) {
  return fullDateFormat(date);
}
function action(data) {
  emit("action", data);
}
function change() {
  checkbox.value = !checkbox.value;
  props.items.forEach((item) => {
    item.check = checkbox.value;
  });
}
const selected = ref([]); */
</script>
