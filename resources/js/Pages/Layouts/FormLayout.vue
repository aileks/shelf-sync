<script setup>
  import NavBar from '@/Components/NavBar.vue';
</script>

<template>
  <NavBar />

  <main>
    <div class="mx-2 mt-10 flex items-center justify-center text-left">
      <div
        class="w-[400px] rounded-lg border border-bronze bg-sandy p-8 text-lg shadow-paper dark:border-dark-sandy dark:bg-dark-bronze"
      >
        <slot />
      </div>
    </div>
  </main>
</template>
