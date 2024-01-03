import axios from "./axios";

export const getCategory = () => axios.get("/categories");
//export const postProduct = (productData) => axios.post("/products", productData);
/*export const postProduct = (productData) => {
  return axios.post("/products", productData);
};
*/
