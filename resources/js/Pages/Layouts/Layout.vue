<script setup>
import NavBar from "../Components/NavBar.vue";
</script>

<template>
  <NavBar />
  <div class="p-2 mt-4 text-center">
    <slot />
  </div>
</template>
