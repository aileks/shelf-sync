<script setup>
import { onMounted, ref } from "vue";
import { ArrowUpRightIcon } from "@heroicons/vue/20/solid";

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
        class="absolute left-0 top-0 h-full w-full rounded-md object-cover"
      />
      <Transition
        enter-active-class="transition-opacity duration-1000 ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition-opacity duration-700 ease-in-out"
        leave-to-class="opacity-0"
      >
        <header
          v-show="animate"
          class="absolute left-0 top-0 flex h-full w-full flex-col items-center justify-center text-neutral-50"
        >
          <div
            class="rounded-md bg-black/50 p-8 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5"
          >
            <h1 class="text-3xl font-bold">Welcome to Quillify!</h1>

            <h2 class="mt-8 text-xl font-semibold">Your personal library.</h2>
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
            class="flex items-center text-sm text-blue hover:underline"
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
