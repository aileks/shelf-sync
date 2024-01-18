<script setup>
  defineProps({
    show: Boolean,
  })
</script>

<template>
  <button class="p-1.5 m-1 drop-shadow-md rounded-lg">
    <slot/>
  </button>
</template>