<script setup>
import { ref } from "vue";

const user = defineProps(["name"]);
const userName = ref(user.name);
</script>

<template>
  <Head title="Profile" />

  <Layout></Layout>
</template>
