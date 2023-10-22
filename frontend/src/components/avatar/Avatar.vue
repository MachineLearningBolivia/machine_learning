<template>
  <div class="flex items-center">
    <div class="flex items-center ml-3">
      <span class="mr-3 text-sm font-medium text-gray-900 dark:text-gray-300"
        ><v-icon name="fa-sun"
      /></span>
      <label class="relative inline-flex items-center cursor-pointer mr-4">
        <input
          type="checkbox"
          value=""
          @click="toggleDark()"
          class="sr-only peer"
          v-model="isDark"
        />
        <div
          class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
        ></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
          ><v-icon name="fa-moon"
        /></span>
      </label>
      <!-- <span class="text-gray-800 dark:text-white mr-4">{{
        profileStore.fullName
      }}</span> -->

      <span class="text-gray-800 dark:text-white mr-4">Usuario</span>
      <v-icon
        name="fa-user"
        class="w-8 h-8 rounded-full bg-gray-600 text-gray-200 p-1"
      />
      <!-- <Dropdown>
        <template v-slot:icon>
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full">
              <span class="sr-only">Open user menu</span>
              <v-icon
                name="fa-user"
                class="w-8 h-8 rounded-full bg-gray-600 text-gray-200 p-1"
              />
            </button>
          </div>
        </template>

        <div
          class="z-50 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        >
          <ul class="py-1" role="none">
            <li>
              <router-link
                to="/profile"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                role="menuitem"
                >Mi información</router-link
              >
            </li>
            <li>
              <router-link
                to="/updatePassword"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
              >
                Actualizar contraseña
              </router-link>
            </li>
            <li>
              <span
                @click="logout"
                class="block px-4 py-2 cursor-pointer text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                role="menuitem"
                >Desconectarse</span
              >
            </li>
          </ul>
        </div>
      </Dropdown> -->
    </div>
  </div>
</template>
<script setup>
import { useDark, useToggle } from "@vueuse/core";

const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>
