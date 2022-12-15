<script setup>
import { ref, inject, onMounted } from "vue";

const axios = inject("axios");
const swal = inject("$swal");

defineProps({
  msg: String,
});

onMounted(() => {
  console.log($("input[name='nome']"));
});

let userObj = ref({
  nome: "",
  email: "",
  pass: "",
  user_role: "",
});

async function onPost() {
  if (
    !$('input[name="name"]').val() ||
    !$('input[name="email"]').val() ||
    !$('input[name="pass"]').val()
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
    console.log($('input[name="name"]').val());
    await axios.post("/add", userObj).then((response) => {
      console.log(response);
      if (response.status == 201) {
        document.location.reload();
      } else {
        swal.fire({
          title: "Ops",
          text: "Alguma coisa saiu errada!",
          icon: "error",
          showCancelButton: false,
          confirmButtonText: "Ok",
        });
      }
    });
  }
}

function clear() {
  var inputs, index;

  inputs = document.getElementsByTagName("input");
  for (index = 0; index < inputs.length; index++) {
    inputs[index].value = "";
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
    <article>
      <h2>CADASTRO</h2>
      <div>
        <label>Nome</label>
      </div>
      <div>
        <input v-model="userObj.nome" name="name" type="text" />
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
      <div><button type="reset" @click="clear()">LIMPAR</button></div>
    </article>
  </div>
</template>

<style scoped></style>
