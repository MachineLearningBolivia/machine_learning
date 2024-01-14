import axios from "./axios";

export const postCategory = (category) => axios.post("/categories", category);

export const getCategories = () => axios.get("/categories");

export const getCategory = (id) => axios.get("/categories/" + id);

export const putCategory = (id, category) =>
  axios.put("/categories/" + id, category);
