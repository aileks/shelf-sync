<script setup>
defineProps({
  show: Boolean,
});
</script>

<template>
  <button
    class="bg-[#69442e] hover:bg-[#69442e99] text-neutral-50 py-1 px-2.5 mx-1 rounded-md"
  >
    <slot />
  </button>
</template>
