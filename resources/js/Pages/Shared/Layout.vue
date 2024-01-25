<script setup>
// import { onMounted, onUnmounted, ref } from "vue";

// const animate = ref(false);

// onMounted(() => {
//   animate.value = true
// })
</script>

<template>
  <!-- <Transition
      enter-active-class="transition-all duration-700 ease-out"
      enter-from-class="-translate-y-8"
      leave-active-class="transition-all duration-700 ease-out"
      leave-to-class="-translate-y-8 opacity-0"
  > -->
  <div class="p-2 mt-4 text-center">
    <slot />
  </div>
  <!-- </Transition> -->
</template>
