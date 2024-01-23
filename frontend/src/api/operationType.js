import axios from "./axios";

export const createOperationTypeRequest = (operation) =>
  axios.post("/operationTypes", operation);

export const getOperationTypesRequest = () => axios.get("/operationTypes");

export const getOperationTypeRequest = (id) =>
  axios.get("/operationTypes/" + id);

export const updateOperationTypeRequest = (id, operation) =>
  axios.put("/operationTypes/" + id, operation);
