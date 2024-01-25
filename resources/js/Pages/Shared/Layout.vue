<script setup>
import NavBar from "./NavBar.vue";
// import { onMounted, onUnmounted, ref } from "vue";

// const animate = ref(false);

// onMounted(() => {
//   animate.value = true
// })
</script>

<template>
  <NavBar />
  <div class="p-2 mt-4 text-center">
    <slot />
  </div>
  <!-- </Transition> -->
</template>
