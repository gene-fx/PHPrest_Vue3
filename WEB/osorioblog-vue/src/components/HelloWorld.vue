<script setup>
import { ref, inject } from "vue";

const axios = inject("axios");
const swal = inject("$swal");

defineProps({
  msg: String,
});

let userObj = ref({
  nome: "",
  email: "",
  pass: "",
  user_role: "",
});

async function onPost() {
  if (
    $("input[name='nome']").val().lenght == 0 ||
    $("input[name='nome']").val() == "" ||
    $("input[name='email']").val().lenght == 0 ||
    $("input[name='email']").val() == "" ||
    $("input[name='pass']").val().lenght == 0 ||
    $("input[name='pass']").val() == ""
  ) {
    $("#post-form").submit((event) => {
      event.preventDefault();
    });
    swal.fire({
      title: "Missing Content",
      text: "Preencha todos os campos!",
      icon: "warning",
      showCancelButton: false,
      confirmButtonText: "Ok",
    });
  } else {
    await axios
      .get("/users")
      .then(async (response) => {
        console.log(response);
      })
      .catch((err) => console.log(err.message));
  }
}

// $("#post-form").submit((event) => {
//   if (
//     $("input[name='nome']").val().lenght == 0 ||
//     $("input[name='nome']").val() == " " ||
//     $("input[name='email']").val().lenght == 0 ||
//     $("input[name='email']").val() == " " ||
//     $("input[name='pass']").val().lenght == 0 ||
//     $("input[name='pass']").val() == " "
//   ) {
//     swal.fire({
//       title: "Missing Content",
//       text: "Preencha todos os campos!",
//       icon: "exclamation",
//       showCancelButton: false,
//       confirmButtonText: "Ok",
//     });
//     event.preventDefault();
//   }
// });

const count = ref(0);
</script>

<template>
  <div>
    <form method="POST" action="" id="post-form">
      <article>
        <h2>CADASTRO</h2>
        <div>
          <label>Nome</label>
        </div>
        <div>
          <input v-model="userObj.nome" name="nome" type="text" />
        </div>
      </article>
      <article>
        <div>
          <label>Email</label>
        </div>
        <div>
          <input v-model="userObj.email" name="email" type="text" />
        </div>
      </article>
      <article>
        <div>
          <label>Senha</label>
        </div>
        <div>
          <input v-model="userObj.pass" name="pass" type="text" />
        </div>
      </article>
      <article>
        <div>
          <label>UserRole</label>
        </div>
        <div>
          <input v-model="userObj.user_role" name="user_role" type="text" />
        </div>
      </article>
      <article>
        <div><button type="submit" @click="onPost()">ENVIAR</button></div>
        <div><button type="reset">LIMPAR</button></div>
      </article>
    </form>
  </div>
</template>

<style scoped></style>
