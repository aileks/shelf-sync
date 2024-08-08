<script setup>
  import NavBar from '../Components/NavBar.vue';
</script>

<template>
  <NavBar />

  <div class="mt-4 p-2 text-center">
    <slot />
  </div>
</template>
