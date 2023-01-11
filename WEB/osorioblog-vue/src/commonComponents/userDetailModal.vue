<template>
  <div class="modal-bg">
    <div class="modal-content">
      <div class="close" id="close-btn">+</div>
      <div>
        <h4>User Info</h4>
      </div>
      <input placeholder="Nome" type="text" />
      <input placeholder="Email" type="text" />
      <select name="" id="">
        <option disabled selected>User Role</option>
        <option v-for="role in userRoles" :key="role.id" :value="role.id">
          {{ role.role }}
        </option>
      </select>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, inject } from "vue";

const axios = inject("axios");
const swal = inject("$swal");

let userRoles = ref([]);

onMounted(async () => {
  await axios
    .get("/roles")
    .then((response) => response.data)
    .then((response) => (userRoles.value = response))
    .catch((err) => console.log(err.message));
});
</script>

<style>
.modal-bg {
  width: 100%;
  height: 100%;
  background-color: rgba(112, 112, 112, 0.65);
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  justify-content: center;
  align-items: center;
  display: none;
}

.modal-content {
  width: 300px;
  height: 600px;
  background-color: black;
  border-radius: 5px;
  position: relative;
}

.close {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 30px;
  transform: rotate(45deg);
  cursor: pointer;
}

.close:hover {
  color: red;
}

input {
  width: 200px;
  display: block;
  margin: 50px auto;
  padding: 8px 8px;
  text-align: center;
}

select {
  width: 200px;
  display: block;
  margin: 50px auto;
  padding: 8px 8px;
  text-align: center;
}
</style>
