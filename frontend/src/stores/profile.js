import { loginRequest, verifyTokenRequest, logoutRequest } from "@/api/auth";
import { defineStore } from "pinia";
import Cookies from "js-cookie";

export const useProfileStore = defineStore("profile", {
  state: () => ({ user: {}, isAuthenticated: false }),
  getters: {
    dataUser: (state) => ({
      name: state.user.data?.name,
      surname: state.user.data?.surname,
      role: state.user.data?.role,
      email: state.user.data?.email,
      phone: state.user.data?.phone,
      avatar: state.user.data?.avatar,
      status: state.user.data?.status,
    }),
    fullName: (state) => state.user.data?.name + " " + state.user.data?.surname,
  },
  actions: {
    async verifyToken() {
      const cookies = Cookies.get();
      if (!cookies.token) {
        this.user = {};
        this.isAuthenticated = false;
        return;
      }
      try {
        const res = await verifyTokenRequest(cookies.token);
        if (!res.data) {
          this.user = {};
          this.isAuthenticated = false;
          return;
        }
        this.user = res.data;
        this.isAuthenticated = true;
      } catch (error) {
        this.user = {};
        this.isAuthenticated = false;
        throw error;
      }
    },
    async login(credentials) {
      try {
        console.log(credentials);
        const res = await loginRequest(credentials);
        Cookies.set("token", res.data.token, { expires: 1 });
        this.user = res.data;
        this.isAuthenticated = true;
      } catch (error) {
        throw error;
      }
    },
    async logout() {
      try {
        await logoutRequest();
        Cookies.remove("token");
        this.user = {};
        this.isAuthenticated = false;
      } catch (error) {
        throw error;
      }
    },
  },
});
