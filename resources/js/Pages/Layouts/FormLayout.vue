<script setup>
  import NavBar from '@/Components/NavBar.vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';
</script>

<template>
  <NavBar />

  <main>
    <div class="mx-2 mt-10 flex items-center justify-center text-left">
      <div
        class="w-[400px] rounded-lg border border-bronze bg-sandy p-8 text-lg shadow-paper"
      >
        <slot />
      </div>
    </div>
  </main>

  <footer
    class="fixed bottom-0 left-0 right-0 mb-1 flex flex-1 flex-col items-center justify-center text-sm dark:text-neutral-50"
  >
    <span
      class="my-2 flex items-center justify-center text-center sm:flex-wrap"
    >
      Please report any issues on&nbsp;
      <a
        @mouseover="isHovered = true"
        @mouseleave="isHovered = false"
        class="ml-[1px] mt-[1px] flex items-center text-blue hover:underline dark:text-dark-green"
        href="https://github.com/aileks/quillify/"
      >
        GitHub.
        <ArrowUpRightIcon
          class="h-4 w-4"
          :class="{
            '-translate-y-0.5 translate-x-0.5 transform transition-transform duration-150':
              isHovered,
          }"
        />
      </a>
    </span>

    <p class="text-center">&copy; 2024 Aaliyah Harper. All rights reserved.</p>
  </footer>
</template>
