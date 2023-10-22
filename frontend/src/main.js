import "./assets/index.css";

import * as FaIcons from "oh-vue-icons/icons/fa";
import * as CoIcons from "oh-vue-icons/icons/co";
import * as GiIcons from "oh-vue-icons/icons/gi";

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";
import { OhVueIcon, addIcons } from "oh-vue-icons";

const Co = Object.values({ ...CoIcons });
const Fa = Object.values({ ...FaIcons });
const Gi = Object.values({ ...GiIcons });

addIcons(...Fa, ...Co, ...Gi);

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.component("v-icon", OhVueIcon);

app.mount("#app");
