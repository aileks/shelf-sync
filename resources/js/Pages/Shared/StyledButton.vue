<script setup>
defineProps({
  show: Boolean,
});
</script>

<template>
  <button
    class="bg-brown hover:bg-brown/80 transition-all duration-300 text-neutral-50 py-1 px-2.5 mx-1 rounded-md"
  >
    <slot />
  </button>
</template>
