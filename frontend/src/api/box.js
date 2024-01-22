import axios from "./axios";

export const getBox = () => axios.get("/boxes");
//export const postProduct = (productData) => axios.post("/products", productData);

export const createBoxRequest = (box) => axios.post("/boxes", box);

export const getBoxesRequest = () => axios.get("/boxes");

export const getBoxRequest = (id) => axios.get("/boxes/" + id);

export const updateBoxRequest = (id, box) => axios.get("/boxes/" + id, box);
