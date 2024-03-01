import axios from "./axios";

export const createCategoriaRequest = (category) =>
  axios.post("/categorias", category);

export const getCategoriasRequest = () => axios.get("/categorias");

export const getCategoriaRequest = (id) => axios.get("/categorias/" + id);

export const updateCategoriaRequest = (id, category) =>
  axios.put("/categorias/" + id, category);

export const importCategoriasRequest = (categories) =>
  axios.post("/categorias/import", categories);
