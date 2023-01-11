import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import VueAxios from "vue-axios";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

axios.defaults.baseURL =
  "http://localhost:8080/osoriostreetblog/api/publichtml/";

const swalOptions = {
  background: "#1e2a36",
  color: "#fff",
  confirmButtonColor: "#00cc00",
  cancelButtonColor: "#d33",
};

const app = createApp(App);

app.use(VueAxios, axios);
app.use(router);
app.use(VueSweetalert2, swalOptions);
app.provide("axios", app.config.globalProperties.axios);
app.mount("#app");
