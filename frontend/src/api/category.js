import axios from "./axios";

export const postCategory = (category) => axios.post("/categories", category);

export const getCategory = () => axios.get("/categories");

export const getCategoryId = (id) => axios.get("/categories/" + id);

export const putCategory = (id, category) =>
  axios.put("/categories/" + id, category);
