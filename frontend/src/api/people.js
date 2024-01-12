import axios from "./axios";

export const getPeople = () => axios.get("/people");

export const postPeople = (peopleData) => axios.post("/people", peopleData);