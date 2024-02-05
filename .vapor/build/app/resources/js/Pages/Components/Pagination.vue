<script setup>
defineProps({
  links: Array,
});
</script>

<template>
  <div>
    <Component
      :is="link.url ? 'Link' : 'span'"
      v-for="link in links"
      :class="{ 'text-neutral-50': !link.url, 'font-bold': link.active }"
      :href="link.url"
      class="px-1"
      v-html="link.label"
    />
  </div>
</template>
