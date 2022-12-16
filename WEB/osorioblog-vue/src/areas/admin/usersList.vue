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

async function getUserInfo(id){
  console.log(id);
  await axios
    .post("/info", id)
    .then((response) => response.data)
    .then((response) => {
      /**
       * TODO tem coisa pra fazer aqui tbm
       * TODO FAZER PAGINA DE INFOS DO USUARIO
       * TODO E ADD EMMITER PRA EMITIR DADOS PARA OUTRO COMPONENTE
       */
      console.log('resposta do axios =' + response);
    })
}
</script>

<template>
  <table>
    <thead>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>UserRole</th>
      <th>Options</th>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.user_role }}</td>
        <td>
          <div><button>Delete</button></div>
          <div><button @click="getUserInfo(user.id)">Info</button></div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
