<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-4/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-white bg-opacity-20 backdrop-blur-md border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
              <h6 class="text-white text-xl font-bold">Inicio</h6>
            </div>
            <hr class="mt-6 border-b-1 border-gray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <div v-if="alertOpen">
              <div
                v-for="(item, index) in errors"
                :key="index"
                class="bg-red-500 p-2 text-white rounded-lg mb-2 text-center"
              >
                {{ item }}
              </div>
            </div>
            <form :onSubmit="handleSubmit">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-gray-200 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Correo
                </label>
                <div
                  class="p-1 mb-1"
                  v-for="(error, index) of v$.email.$errors"
                  :key="index"
                >
                  <p class="text-sm text-red-500">{{ error.$message }}</p>
                </div>
                <input
                  v-model="v$.email.$model"
                  type="email"
                  class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Email"
                />
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-gray-200 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Contraseña
                </label>
                <div
                  class="p-1 mb-1"
                  v-for="(error, index) of v$.password.$errors"
                  :key="index"
                >
                  <p class="text-sm text-red-500">{{ error.$message }}</p>
                </div>
                <input
                  v-model="v$.password.$model"
                  type="password"
                  class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                />
              </div>

              <div class="text-center mt-6">
                <button
                  class="bg-gray-800 text-white active:bg-gray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="submit"
                >
                  Ingresar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { reactive, computed, ref } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required, email, minLength, helpers } from "@vuelidate/validators";
import { useProfileStore } from "@/stores/profile";

const profileStore = useProfileStore();

const errors = ref([]);
const alertOpen = ref();
const formData = reactive({
  email: "",
  password: "",
});

const rules = computed(() => ({
  email: {
    email: helpers.withMessage("El email no es válido", email),
    required: helpers.withMessage("El email es requerido", required),
  },
  password: {
    required: helpers.withMessage("La contraseña es requerida", required),
    minLength: helpers.withMessage(
      "La contraseña debe tener al menos 6 caracteres",
      minLength(6)
    ),
  },
}));

const v$ = useVuelidate(rules, formData);

async function handleSubmit(event) {
  event.preventDefault();
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      await profileStore.login(formData);
      location.reload();
    } catch (error) {
      errors.value = error.response.data.errors;
      notification();
    }
  }
}
function notification() {
  alertOpen.value = true;
  const timer = setTimeout(() => {
    alertOpen.value = false;
  }, 3000);
  return () => clearTimeout(timer);
}
</script>