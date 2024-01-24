import axios from "./axios";

export const createConfigurationRequest = (configuration) =>
  axios.post("/configurations", configuration);

export const getConfigurationsRequest = () => axios.get("/configurations");

export const getConfigurationRequest = (id) =>
  axios.get("/configurations/" + id);

export const updateConfigurationRequest = (id, configuration) =>
  axios.get("/configurations/" + id, configuration);
