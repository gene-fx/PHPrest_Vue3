import { createRouter, createWebHistory } from "vue-router";

import Login from "../areas/user/login.vue";

const routes = [
  {
    path: "/",
    name: "Login",
    component: Login,
  },
  {
    path: "/addUser",
    name: "AddUser",
    component: () =>
      import(/* webpackChunkName: "userReg" */ "../areas/user/userReg.vue"),
  },
  {
    path: "/userList",
    name: "UserList",
    component: () =>
      import(/* webpackChunkName: "userList" */ "../areas/admin/userList.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
