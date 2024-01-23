import axios from "./axios";

export const getOperation = () => axios.get("/operations");
//export const postProduct = (productData) => axios.post("/products", productData);
export const createOperationRequest = (operation) =>
  axios.post("/operations", operation);

export const getOperationsRequest = () => axios.get("/operations");

export const getOperationRequest = (id) => axios.get("/operations/" + id);

export const updateOperationRequest = (id, operation) =>
  axios.put("/operations/" + id, operation);
