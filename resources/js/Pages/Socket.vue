<template>
    <div class="container mt-5">
        <div
            v-if="join"
            class="alert alert-info"
            role="alert"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            :title="'Se ha unido el usuario ' + join.name"
        >
            Se ha unido {{ join.name }}
        </div>

        <div
            v-if="leaving"
            class="alert alert-danger"
            role="alert"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            :title="'Se ha unido el usuario ' + leaving.name"
        >
            Se ha hido {{ leaving.name }}
        </div>

        <div
            v-if="writting"
            class="alert alert-success"
            role="alert"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            :title="'Se ha unido el usuario ' + writting"
        >
            {{ writting }} Te está Escribiendo......
        </div>

        <h1 class="text-center">
            Chat en Vivo con {{ $page.props.auth.user.name }}
        </h1>
        <div class="card">
            <div class="card-body">
                <div class="messages mb-3">
                    <div
                        v-for="message in messages"
                        :key="message.id"
                        class="alert alert-secondary"
                    >
                        <strong>{{ $page.props.auth.user.name }}:</strong> {{ message.text }}
                    </div>
                </div>
                <form @submit.prevent="sendMessage" class="d-flex">
                    <input
                        v-model="newMessage"
                        type="text"
                        class="form-control me-2"
                        placeholder="Escribe tu mensaje..."
                        required
                    />
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

import axios from "axios";

const { props } = usePage();

const messages = ref([]);
const newMessage = ref("");
const join = ref(false);
const writting = ref(false);
const leaving = ref(false);
const user = ref(false);

watch(newMessage, (newValue, oldValue) => {
    if (newValue !== "") {
        window.Echo.join("testing").whisper("typing", props.auth.user);
    } else {
        window.Echo.join("testing").whisper("typing", null);
    }
});

onMounted(() => {
    window.Echo.join(`testing`)
        .listenForWhisper("typing", (e) => {
            if (e) {
                writting.value = e.name;
                console.log(e);
            } else {
                writting.value = false;
                console.log(e);
            }
        })
        .joining((users) => {
            join.value = users;
            setTimeout(() => (join.value = false), 1000);
        })
        .here((users) => {
            console.log(users);
        })
        .listen("TestEvent", (event) => {
            let e = event.data;
            messages.value.push({
                id: e.id,
                user: e.user,
                text: e.message,
            });
        })
        .leaving((users) => {
            leaving.value = users;
            setTimeout(() => (leaving.value = false), 1000);
        });
});

const sendMessage = async () => {
    if (newMessage.value.trim() === "") return;

    let res = await axios.post("/api/messages", {
        user: user,
        message: newMessage.value,
    });

    console.log(res.data);
    newMessage.value = "";
};
</script>

<style scoped>
.messages {
    max-height: 300px;
    overflow-y: auto;
}
</style>
