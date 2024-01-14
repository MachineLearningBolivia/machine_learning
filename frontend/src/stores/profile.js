import { defineStore } from "pinia";
import Cookies from "js-cookie";
import { loginRequest } from "@/api/auth";

export const useProfileStore = defineStore("profile", {
  state: () => ({ user: {}, isAuthenticated: false }),
  getters: {
    dataUser: (state) => ({
      email: state.user.data.email,
      name: state.user.data?.name,
      surname: state.user.data?.surname,
      role: state.user.data?.role,
      email: state.user.data?.email,
      phone: state.user.data?.phone,
    }),
    fullName: (state) => state.user.data?.name + " " + state.user.data?.surname,
    // isAdmin: (state) => state.user.admin,
  },
  actions: {
    async login(email, password) {
      try {
        const res = await loginRequest(email, password);
        Cookies.set("token", res.data.token, { expires: 1 });
        this.user = res.data;
        this.isAuthenticated = true;
      } catch (error) {
        throw error;
      }
    },
    async logout() {
      try {
        Cookies.remove("token");
        this.user = {};
        this.isAuthenticated = false;
      } catch (error) {
        throw error;
      }
    },
  },
});
