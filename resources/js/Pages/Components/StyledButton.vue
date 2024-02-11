<script setup>
defineProps({
  isLoading: Boolean,
});
</script>

<template>
  <button
    :disabled="isLoading"
    class="disabled:bg- mx-1 rounded-md bg-brown px-2.5 py-1 text-neutral-50 shadow-paper transition-all duration-300 hover:bg-brown/80 hover:shadow-none"
  >
    <slot />
  </button>
</template>
