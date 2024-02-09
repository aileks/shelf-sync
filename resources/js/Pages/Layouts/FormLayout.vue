<script setup>
import NavBar from "@/Components/NavBar.vue";
</script>

<template>
  <NavBar />

  <main>
    <div class="flex items-center text-left mx-2 justify-center mt-16">
      <div
        class="bg-sandy p-8 w-[400px] text-lg rounded-lg border border-bronze shadow-paper"
      >
        <slot />
      </div>
    </div>
  </main>
</template>
