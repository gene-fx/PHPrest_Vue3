<script setup>
import { inject, onMounted, ref } from "vue";

const axios = inject("axios");

let users = ref([]);

onMounted(async () => {
  await axios
    .get("/users")
    .then((response) => response.data)
    .then((response) => response.data)
    .then((response) => (users.value = response))
    .catch((err) => console.log(err.message));
});
</script>

<template>
  <table>
    <thead>
      <th>Nome</th>
      <th>Email</th>
      <th>UserRole</th>
      <th>Options</th>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.user_role }}</td>
        <td>
          <div><button>Delete</button></div>
          <div><button>Info</button></div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
