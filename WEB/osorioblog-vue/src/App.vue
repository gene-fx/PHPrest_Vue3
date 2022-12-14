<script setup>
import userReg from "./areas/user/userReg.vue";
import UserList from "./areas/admin/usersList.vue";
</script>

<template>
  <div>
    <UserList />
    <userReg />
  </div>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
