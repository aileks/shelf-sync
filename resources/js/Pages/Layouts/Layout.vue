<script setup>
  import { onMounted, onUnmounted, ref } from 'vue';
  import NavBar from '../Components/NavBar.vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';

  const isMobile = ref(window.innerWidth <= 800);
  const isHovered = ref(false);

  const updateIsMobile = () => {
    isMobile.value = window.innerWidth <= 800;
  };

  onMounted(() => {
    window.addEventListener('resize', updateIsMobile);
    if (success) {
      setTimeout(() => {
        success.value = null;
      }, 1000);
    }
  });

  onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile);
  });
</script>

<template>
  <NavBar />

  <div class="mt-4 p-2 text-center">
    <slot />
  </div>

  <footer
    v-show="!isMobile"
    class="absolute bottom-0 left-0 right-0 mb-1 flex flex-1 flex-col items-center justify-center text-sm text-sm dark:text-neutral-50"
  >
    <span
      class="my-2 flex items-center justify-center text-center sm:flex-wrap"
    >
      Please report any issues on&nbsp;&nbsp;
      <a
        @mouseover="isHovered = true"
        @mouseleave="isHovered = false"
        class="flex items-center text-green hover:underline dark:text-dark-green"
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
