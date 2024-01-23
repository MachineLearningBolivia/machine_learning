import axios from "./axios";

export const createUserRequest = (user) => axios.post("/users", user);

export const getUsersRequest = () => axios.get("/users");

export const getUserRequest = (id) => axios.get("/users/" + id);

export const updateUserRequest = (id, user) => axios.put("/users/" + id, user);
