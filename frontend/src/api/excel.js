import axios from "./axios";

export const importCategoriesRequest = (data) =>
  axios.post("/import/categories", data);
