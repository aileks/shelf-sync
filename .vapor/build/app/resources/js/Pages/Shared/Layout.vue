<script setup>
import NavBar from "./NavBar.vue";
</script>

<template>
  <NavBar />
  <div class="p-2 mt-4 text-center">
    <slot />
  </div>
</template>
