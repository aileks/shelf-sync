<script setup>
  import NavBar from '@/Components/NavBar.vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';
</script>

<template>
  <NavBar />

  <main>
    <div class="mx-2 mt-10 flex items-center justify-center text-left">
      <div
        class="w-[400px] rounded-lg border border-accent bg-tan p-8 text-lg shadow-paper dark:border-dark-accent dark:bg-dark-tan"
      >
        <slot />
      </div>
    </div>
  </main>
</template>
