<script setup>
defineProps({
  show: Boolean,
});
</script>

<template>
  <button class="bg-[#d7bda3] hover:bg-[#d7bda399] p-1.5 m-1 rounded-md">
    <slot />
  </button>
</template>
