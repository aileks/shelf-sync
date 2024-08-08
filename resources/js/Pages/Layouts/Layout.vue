<script setup>
  import { onMounted, onUnmounted, ref } from 'vue';
  import NavBar from '../Components/NavBar.vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';

  const isHovered = ref(false);
</script>

<template>
  <NavBar />

  <div class="relative mt-4 text-center">
    <slot />
  </div>

  <footer
    class="absolute left-0 right-0 flex flex-col bg-bronze text-sm text-neutral-50 dark:bg-dark-bronze"
  >
    <span
      class="my-2 flex items-center justify-center text-center sm:flex-wrap"
    >
      Please report any issues on&nbsp;&nbsp;
      <a
        @mouseover="isHovered = true"
        @mouseleave="isHovered = false"
        class="mt-[3px] flex items-center justify-center align-bottom text-blue hover:underline dark:text-dark-blue"
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

    <p class="mb-2 text-center">
      &copy; 2024 Aaliyah Harper. All rights reserved.
    </p>
  </footer>
</template>
