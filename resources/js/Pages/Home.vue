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
    <div class="relative h-[300px] w-auto sm:h-[40vh]">
      <img
        src="https://raw.githubusercontent.com/aileks/quillify/main/public/library.jpeg"
        class="absolute inset-0 h-[300px] w-full rounded-md object-cover sm:h-full"
      />

      <div
        class="absolute inset-0 h-full rounded-md bg-gradient-to-r from-gray-900/80 to-gray-800/80 sm:h-full"
      ></div>

      <header
        class="flex h-full flex-col items-center justify-center text-neutral-50"
      >
        <Transition
          enter-active-class="transition-opacity duration-1000 ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition-opacity duration-700 ease-in-out"
          leave-to-class="opacity-0"
        >
          <div v-show="animate" class="z-10">
            <h1 class="mb-4 text-2xl font-bold sm:text-5xl">
              Organize Your Reading Life With Quillify
            </h1>

            <p class="my-8 text-lg sm:text-2xl">
              Track and share your literary journey
            </p>

            <Link href="/register">
              <button
                class="dark:bg-dark-green dark:hover:bg-dark-green/85 rounded-md bg-green px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-green/90 hover:shadow-none"
              >
                Create Your Personal Library
              </button>
            </Link>
          </div>
        </Transition>
      </header>
    </div>

    <main
      class="relative flex flex-col items-center justify-center overflow-hidden"
    >
      <img
        class="absolute left-0 top-5 h-full w-full -rotate-2 rounded-lg object-cover opacity-80 drop-shadow-md"
        src="https://raw.githubusercontent.com/aileks/quillify/main/public/table.png"
        alt="table of books"
      />

      <div
        class="dark:bg-dark-primary relative my-10 w-3/4 rounded-lg bg-sandy px-8 py-12 sm:h-full"
      >
        <p class="px-4 text-base font-medium sm:text-lg">
          Quillify is your simple, elegant solution for tracking your reading
          journey. Effortlessly manage your book collection our searchable list
          and keep your reading goals on track.
        </p>

        <p class="mt-4 px-4 text-base font-medium sm:text-lg">
          Discover a more organized and enjoyable reading experience with
          Quillify.
        </p>

        <Link href="/register">
          <button
            class="dark:bg-dark-green dark:hover:bg-dark-green/85 relative mt-8 rounded-md bg-green px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-green/90 hover:shadow-none"
          >
            Start Now!
          </button>
        </Link>
      </div>
    </main>

    <footer class="mt-12 flex flex-col items-center justify-center text-sm">
      <span
        class="my-2 flex items-center justify-center text-center sm:flex-wrap"
      >
        Please report any issues on&nbsp;
        <a
          @mouseover="isHovered = true"
          @mouseleave="isHovered = false"
          class="dark:text-dark-blue mt-[1px] flex items-center text-blue hover:underline"
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

      <p class="text-center">
        &copy; 2024 Aaliyah Harper. All rights reserved.
      </p>
    </footer>
  </Layout>
</template>
