<script setup>
  import { onMounted, onUnmounted, ref } from 'vue';
  import NavBar from '../Components/NavBar.vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';

  const isHovered = ref(false);
</script>

<template>
  <NavBar />

  <div class="relative mt-4 text-center">
    <slot />
  </div>
</template>
