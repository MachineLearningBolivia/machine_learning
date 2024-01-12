import { defineStore } from "pinia";
import Cookies from "js-cookie";
import { loginRequest } from "../../api/auth";

export const useProfileStore = defineStore("profile", {
  state: () => ({ user: {}, isAuthenticated: false }),
  getters: {
    dataUser: (state) => ({
      email: state.user.email,
      first_name: state.user.user?.first_name,
      last_name: state.user.user?.last_name,
      address: state.user.user?.address,
      telf: state.user.user?.telf,
      cel: state.user.user?.cel,
      ci: state.user.user?.ci,
    }),
    fullName: (state) =>
      state.user.user?.first_name + " " + state.user.user?.last_name,
    isAdmin: (state) => state.user.admin,
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