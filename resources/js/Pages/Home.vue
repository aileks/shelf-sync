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
    <div class="flex h-screen flex-col justify-center">
      <div
        class="flex-0 relative z-0 my-8 flex w-auto flex-col items-center justify-center sm:mb-16"
      >
        <img
          v-show="animate"
          class="absolute h-[300px] w-[600px] rounded-md object-cover blur-[6px] sm:h-full sm:w-full"
          src="https://raw.githubusercontent.com/aileks/quillify/main/public/library.jpeg"
        />

        <header
          class="z-10 mx-4 my-6 flex flex-col items-center justify-center place-self-center self-center rounded-md text-neutral-50 sm:mb-12"
        >
          <Transition
            enter-active-class="transition-opacity duration-1000 ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition-opacity duration-700 ease-in-out"
            leave-to-class="opacity-0"
          >
            <div
              class="text-shadow text-overlay z-10 h-full w-full rounded-md px-4 text-center"
            >
              <h1
                class="my-2 text-xl font-bold sm:my-4 sm:text-2xl md:text-4xl"
              >
                Organize Your Reading Life With Quillify
              </h1>

              <p
                class="my-6 rounded-md pt-4 text-base sm:my-12 sm:text-lg md:text-2xl"
              >
                Track and share your literary journey
              </p>

              <Link href="/register">
                <button
                  class="mb-4 rounded-md bg-green px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-green/90 hover:shadow-none dark:bg-dark-blue dark:hover:bg-dark-blue/90"
                >
                  Create Your Personal Library
                </button>
              </Link>
            </div>
          </Transition>
        </header>
      </div>

      <main
        class="relative mt-8 flex flex-1 flex-col items-center justify-center overflow-clip"
      >
        <img
          class="absolute left-0 top-0 z-[-1] h-full w-full -rotate-2 rounded-lg object-cover opacity-80 blur-[4px] drop-shadow-md"
          src="https://raw.githubusercontent.com/aileks/quillify/main/public/table.png"
          alt="table of books"
        />

        <div
          class="relative my-4 w-11/12 rounded-lg bg-bronze px-4 py-6 text-neutral-50 dark:bg-dark-bronze sm:my-10 sm:px-8 sm:py-12 md:w-2/3"
        >
          <p class="px-2 text-base font-medium sm:px-4 sm:text-lg md:text-xl">
            Quillify is your simple, elegant solution for tracking your reading
            journey. Effortlessly manage your book collection with our
            searchable list and keep your reading goals on track.
          </p>

          <p
            class="mt-2 px-2 text-base font-medium sm:mt-4 sm:px-4 sm:text-lg md:text-xl"
          >
            Discover a more organized and enjoyable reading experience with
            Quillify.
          </p>

          <Link href="/register">
            <button
              class="relative mt-4 rounded-md bg-green px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-green/90 hover:shadow-none dark:bg-dark-blue dark:hover:bg-dark-blue/90 sm:mt-8"
            >
              Start Now!
            </button>
          </Link>
        </div>
      </main>
    </div>

    <footer
      class="absolute left-0 right-0 my-4 flex flex-col bg-sandy text-sm text-neutral-900 dark:bg-dark-sandy dark:text-neutral-50"
    >
      <span class="mt-3 flex items-center justify-center text-center">
        Please report any issues on&nbsp;&nbsp;
        <a
          @mouseover="isHovered = true"
          @mouseleave="isHovered = false"
          class="mt-[3px] flex items-center justify-center align-bottom text-green hover:underline dark:text-dark-green"
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

      <p class="my-2 text-center">
        &copy; 2024 Aaliyah Harper. All rights reserved.
      </p>
    </footer>
  </Layout>
</template>

<style scoped>
  .text-shadow {
    text-shadow: 2px 2px 4px rgb(0, 0, 0);
  }

  .text-overlay {
    background: rgba(0, 0, 0, 0.6);
    padding: 1rem;
  }
</style>
