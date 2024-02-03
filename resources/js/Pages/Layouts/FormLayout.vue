<script setup>
import NavBar from "@/Components/NavBar.vue";
</script>

<template>
  <NavBar />

  <main>
    <div class="flex items-center justify-center mt-12">
      <div
        class="bg-sandy p-8 w-[400px] text-lg rounded-lg border border-bronze shadow-paper"
      >
        <slot />
      </div>
    </div>
  </main>
</template>
