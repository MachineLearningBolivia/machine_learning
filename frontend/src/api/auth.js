import axios from "./axios";

export const loginRequest = (user) => axios.post("/auth/login", user);

export const verifyTokenRequest = () => axios.get("/auth/verify");

export const logoutRequest = () => axios.post("/auth/logout");
