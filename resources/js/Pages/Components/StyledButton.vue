<script setup>
  defineProps({
    isProcessing: Boolean,
  });
</script>

<template>
  <button
    :disabled="isProcessing"
    class="dark:hover:bg-dark-brown/90 dark:bg-dark-brown mx-1 rounded-md bg-brown px-2.5 py-1 text-neutral-50 shadow-paper transition-all duration-300 hover:bg-brown/90 hover:shadow-none disabled:bg-brown/50"
  >
    <slot />
  </button>
</template>
