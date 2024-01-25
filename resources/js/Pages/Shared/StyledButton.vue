<script setup>
defineProps({
  show: Boolean,
});
</script>

<template>
  <button
    class="bg-[#d7bda3] hover:bg-[#d7bda3d9] p-1.5 m-1 drop-shadow-md rounded-lg"
  >
    <slot />
  </button>
</template>
