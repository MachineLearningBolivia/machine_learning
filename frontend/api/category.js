import axios from "./axios";

export const getCategory = () => axios.get("/categories");
export const postCategory = (categoryData) => axios.post("/categories", categoryData);
/*export const postProduct = (productData) => {
  return axios.post("/products", productData);
};
*/
