<script setup>
import { ref, inject } from "vue";

const axios = inject("axios");

async function logIn() {
    let user = document.getElementById("user").value;
    let pass = document.getElementById("pass").value;
    axios
        .post("/login", {user, pass})
        .then((response) => response.data)
        .then((response) => console.log(response));
}
</script>

<template>
    <div>
        <article>
            <div><label>Usuário</label></div>
            <div><input id="user" placeholder="EMAIL" type="text"></div>
        </article>
        <article>
            <div><label>Senha</label></div>
            <div><input id="pass" placeholder="SENHA" type="password"></div>
        </article>
        <article>
            <div><button @click="logIn()">Entrar</button></div>
        </article>
    </div>
</template>