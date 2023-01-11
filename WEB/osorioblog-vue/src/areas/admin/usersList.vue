<script setup>
import { inject, onMounted, ref, getCurrentInstance } from "vue";
import userDetailModal from "../../commonComponents/userDetailModal.vue";

const axios = inject("axios");

const _this = getCurrentInstance();

let user = ref();

let users = ref([]);

onMounted(async () => {
  await axios
    .get("/users", "1")
    .then((response) => response.data)
    .then((response) => (users.value = response))
    .catch((err) => console.log(err.message));
});

async function getUserInfo(id) {
  await axios
    .post("/userInfo", id)
    .then((response) => response.data)
    .then((response) => {
      user.value = response;
      _this.emit("userInfo", user);
    })
    .catch((err) => console.log(err.message));
}
</script>

<template>
  <div>
    <userDetailModal />
    <table>
      <thead>
        <th style="width: 5%">Id</th>
        <th style="width: 50%">Nome</th>
        <th style="width: 10%">UserRole</th>
        <th style="width: 25%">Options</th>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.role }}</td>
          <td>
            <div>
              <button>Delete</button>
              <button @click="getUserInfo(user.id)">Info</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
table {
  font-size: medium;
  width: 100%;
  padding: 50px;
  border: none;
  border-radius: 5px;
  border-collapse: collapse;
}

thead {
  font-weight: bold;
  background-color: #272727;
  color: rgb(255, 255, 255);
}

tbody tr:nth-child(odd) {
  background-color: #2c2c2c;
  font-size: 0.9em;
  text-align: center;
}

tbody tr:nth-child(even) {
  background-color: #242424;
  font-size: 0.9em;
  text-align: center;
}

button {
  padding: 9px 7px;
  margin: 3px;
  display: inline;
  font-size: smaller;
  width: auto;
}
</style>
