import axios from "./axios";

export const createPersonRequest = (person) => axios.post("/people", person);

export const getPeopleRequest = () => axios.get("/people");

export const getPersonRequest = (id) => axios.get("/people/" + id);

export const updatePersonRequest = (id, person) =>
  axios.put("/people/" + id, person);
