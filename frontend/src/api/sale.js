import axios from "./axios";

export const createSaleRequest = (sale) => axios.post("/sales", sale);

export const getSalesRequest = () => axios.get("/sales");

export const getSaleRequest = (id) => axios.get("/sales/" + id);

export const updateSaleRequest = (id, sale) => axios.put("/sales/" + id, sale);
