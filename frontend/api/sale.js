import axios from "./axios";

export const getSale = () => axios.get("/sales");