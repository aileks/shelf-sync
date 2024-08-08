<script setup>
  import NavBar from '../Components/NavBar.vue';
</script>

<template>
  <NavBar />

  <div class="relative mt-4 text-center">
    <slot />
  </div>
</template>
