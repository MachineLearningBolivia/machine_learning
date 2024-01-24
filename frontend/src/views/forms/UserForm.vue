<script setup>
import {
  createUserRequest,
  getUserRequest,
  updateUserRequest,
} from "@/api/user";
import { useRoute, useRouter } from "vue-router";
import { reactive, ref, onMounted } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { helpers, required, email } from "@vuelidate/validators";
import { toast } from "vue-sonner";
import Forms from "@/components/cards/Forms.vue";
import Input from "@/components/inputs/Input.vue";

const route = useRoute();
const router = useRouter();
const formData = reactive({
  name: "",
  surname: "",
  role: "",
  email: "",
  phone: "",
  avatar: "",
  status: "",
});
const rules = {
  name: { required: helpers.withMessage("Se requiere el nombre", required) },
  surname: {
    required: helpers.withMessage("Se requiere el apellido", required),
  },
  role: { required: helpers.withMessage("Se requiere un rol", required) },
  email: {
    required: helpers.withMessage("Se requiere el email", required),
    email: helpers.withMessage("El email no es válido", email),
  },
  phone: {
    required: helpers.withMessage("Se requiere un teléfono", required),
  },
  avatar: {
    required: helpers.withMessage("Se requiere un avatar", required),
  },
  status: {
    required: helpers.withMessage("Se requiere un estado", required),
  },
  password: {},
};
const v$ = useVuelidate(rules, formData);
const errors = ref([]);

async function handleSubmit() {
  const isFormCorrect = await v$.value.$validate();
  if (isFormCorrect) {
    try {
      if (!route.query.id) {
        formData.password = "holamundo";
        await createUserRequest({
          json: JSON.stringify(formData),
        });
        toast.success("Usuario guardada correctamente");
      } else {
        await updateUserRequest(route.query.id, {
          json: JSON.stringify(formData),
        });
        toast.success("Usuario actualizada correctamente");
      }
      router.push("/users");
    } catch (error) {
      toast.error(
        "Error al añadir el usuario, por favor verifique que los datos estén correctos"
      );
    }
  }
}

onMounted(async () => {
  if (route.query.id) {
    try {
      const res = await getUserRequest(route.query.id);
      Object.assign(formData, res.data.user);
    } catch (error) {
      toast.error("Error al cargar datos");
      router.push("/users");
    }
  }
});
</script>

<template>
  <Forms
    title="Información del cliente"
    icon="fa-user-cog"
    @handleSubmit="handleSubmit"
  >
    <h6
      class="text-gray-400 dark:text-gray-100 text-sm mt-3 mb-6 font-bold uppercase"
    >
      Datos del usuario
    </h6>
    <div class="flex flex-wrap">
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="name"
          labelText="Nombre"
          v-model="v$.name.$model"
          :errors="v$.name.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="surname"
          labelText="Apellido"
          v-model="v$.surname.$model"
          :errors="v$.surname.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="email"
          labelText="Email"
          v-model="v$.email.$model"
          :errors="v$.email.$errors"
          type="email"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="phone"
          labelText="Teléfono"
          v-model="v$.phone.$model"
          :errors="v$.phone.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-full px-4">
        <Input
          id="avatar"
          labelText="Imagen"
          v-model="v$.avatar.$model"
          :errors="v$.avatar.$errors"
          type="url"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="role"
          labelText="Rol"
          v-model="v$.role.$model"
          :errors="v$.role.$errors"
          type="text"
        />
      </div>
      <div class="w-full lg:w-6/12 px-4">
        <Input
          id="status"
          labelText="Estado"
          v-model="v$.status.$model"
          :errors="v$.status.$errors"
          type="text"
        />
      </div>
    </div>
  </Forms>
</template>
