import axios from "./axios";

export const postProduct = (product) => {
  return axios.post("/products", product);
};

export const getProducts = () => axios.get("/products");

export const getProduct = (id) => axios.get("/products/" + id);
