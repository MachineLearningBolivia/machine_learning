<script setup>
import {
  createPersonRequest,
  getPersonRequest,
  updatePersonRequest,
} from "@/api/person";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Forms.vue";
import Input from "@/components/inputs/Input.vue";

const route = useRoute();
const router = useRouter();
const formData = reactive({
  name: "",
  country: "",
  city: "",
});
const rules = {
  name: {
    required: helpers.withMessage("Se requiere el nombre", required),
  },
  country: {
    required: helpers.withMessage("Se requiere el país", required),
  },
  city: {
    required: helpers.withMessage("Se requiere la ciudad", required),
  },
};
const v$ = useVuelidate(rules, formData);
const errors = ref([]);

async function handleSubmit() {
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      if (!route.query.id) {
        await createPersonRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Usuario guardada correctamente");
      } else {
        await updatePersonRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Usuario actualizada correctamente");
      }
      router.push("/people");
    } catch (error) {
      toast.error(
        "Error al añadir la categoría, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getPersonRequest(route.query.id);
      Object.assign(formData, res.data.person);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/people");
    }
  }
});
</script>

<template>
  <Forms
    title="Información del cliente"
    icon="fa-user-tie"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del cliente
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-full px-4">
        <Input
          id="name"
          labelText="Nombre"
          v-model="v$.name.$model"
          :errors="v$.name.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input
          id="city"
          labelText="Ciudad"
          v-model="v$.city.$model"
          :errors="v$.city.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input
          id="country"
          labelText="País"
          v-model="v$.country.$model"
          :errors="v$.country.$errors"
          type="text"
        />
      </div>
    </div>
  </Forms>
</template>
