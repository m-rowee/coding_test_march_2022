/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "bootstrap/dist/js/bootstrap.esm.js";

import { createApp } from "vue";
import { createPinia } from "pinia";

import Login from "./components/Login";
import Dashboard from "./components/Dashboard";
import Register from "./components/Register";
import Home from "./components/Home";
import ProfileInfo from "./components/ProfileInfo";
import router from "./router";

const app = createApp({});

app.use(createPinia());
app.use(router);

app.component("login", Login)
    .component("register", Register)
    .component("dashboard", Dashboard)
    .component("home", Home)
    .component("profile-info", ProfileInfo);
app.mount("#app");
