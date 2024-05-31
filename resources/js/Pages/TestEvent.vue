<template>
    <h1>Esta Pagina Dice: " {{ $page.props.queryData }} "</h1>
</template>
<script setup>
import { onMounted } from 'vue'
onMounted(() => {
    // Echo.channel("testing").listen("TestEvent", (e) => {
    //     console.log("Message");
    //     console.log(e);
    // });
});
</script>
