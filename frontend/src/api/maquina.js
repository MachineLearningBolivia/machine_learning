import axios from "./axios";

export const createMaquinaRequest = (maquina) =>
  axios.post("/maquinaria", maquina);

export const getMaquinasRequest = () => axios.get("/maquinaria");

export const getMaquinaRequest = (id) => axios.get("/maquinaria/" + id);

export const updateMaquinaRequest = (id, maquina) =>
  axios.put("/maquinaria/" + id, maquina);

export const importMaquinasRequest = (maquinas) =>
  axios.post("/maquinaria/import", maquinas);
