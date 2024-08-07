<script setup>
  import { onMounted, ref } from 'vue';
  import { ArrowUpRightIcon } from '@heroicons/vue/20/solid';

  const animate = ref(false);

  onMounted(() => {
    animate.value = true;
  });

  const isHovered = ref(false);
</script>

<template>
  <Head title="Your Personal Library" />

  <Layout>
    <div class="relative h-[60vh] w-auto sm:h-[40vh] md:h-[50vh]">
      <img
        src="https://raw.githubusercontent.com/aileks/quillify/main/public/library.jpeg"
        class="gradient absolute inset-0 h-full w-full rounded-md object-cover"
      />
      <div
        class="absolute inset-0 bg-gradient-to-r from-amber-900/70 to-emerald-900/70 dark:from-gray-900/80 dark:to-gray-800/80"
      ></div>
      <Transition
        enter-active-class="transition-opacity duration-1000 ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition-opacity duration-700 ease-in-out"
        leave-to-class="opacity-0"
      >
        <header
          v-show="animate"
          class="flex h-full w-full flex-col items-center justify-center text-neutral-50"
        >
          <div class="relative z-10 text-center text-white">
            <h1 class="mb-4 text-5xl font-bold">
              Organize Your Reading Life with Quillify
            </h1>

            <p class="mb-8 text-2xl">Track and share your literary journey</p>

            <button
              class="rounded-lg bg-bronze px-4 py-2 font-bold text-white transition duration-300 hover:bg-bronze/90"
            >
              Start Your Free Library
            </button>
          </div>
        </header>
      </Transition>
    </div>

    <main>
      <p class="mt-4 text-center text-lg">
        Quillify is a simple and minimal way to keep track of your TBR list!
      </p>

      <span
        class="mt-2 flex items-center justify-center text-center text-base sm:flex-wrap"
      >
        <div class="flex flex-wrap justify-center">
          Currently in beta. Please report any issues on&nbsp;
          <a
            @mouseover="isHovered = true"
            @mouseleave="isHovered = false"
            class="mt-[2px] flex items-center text-sm text-blue hover:underline"
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
        </div>
      </span>
    </main>

    <div class="flex justify-center">
      <footer class="absolute bottom-0 mb-1 pb-1 text-xs">
        <p class="text-center">
          &copy; 2024 Aaliyah Harper. All rights reserved.
        </p>
      </footer>
    </div>
  </Layout>
</template>
