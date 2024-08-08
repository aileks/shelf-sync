<script setup>
  import { onMounted, ref } from 'vue';

  const animate = ref(false);

  onMounted(() => {
    animate.value = true;
  });
</script>

<template>
  <Head title="Your Personal Library" />

  <Layout>
    <div class="flex h-screen flex-col justify-center">
      <div
        class="flex-0 relative z-0 flex w-auto flex-col items-center justify-center sm:mb-16"
      >
        <img
          class="absolute inset-0 w-full rounded-md object-cover blur-sm sm:h-full"
          src="https://raw.githubusercontent.com/aileks/quillify/main/public/library.jpeg"
        />

        <!-- <div -->
        <!--   class="absolute inset-0 h-full rounded-md bg-gradient-to-r from-gray-900/80 to-gray-800/80 sm:h-full" -->
        <!-- ></div> -->

        <header
          class="z-10 ml-4 mr-3 mt-2 flex flex-col items-center justify-center place-self-center self-center rounded-md text-neutral-50 sm:mb-12"
        >
          <Transition
            enter-active-class="transition-opacity duration-1000 ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition-opacity duration-700 ease-in-out"
            leave-to-class="opacity-0"
          >
            <div v-show="animate" class="z-10 h-full w-full px-4 text-center">
              <h1
                class="text-shadow text-overlay my-2 rounded-md text-xl font-bold sm:my-4 sm:text-2xl md:text-4xl"
              >
                Organize Your Reading Life With Quillify
              </h1>

              <p
                class="text-shadow text-overlay my-6 rounded-md pt-4 text-base sm:my-12 sm:text-lg md:text-2xl"
              >
                Track and share your literary journey
              </p>

              <Link href="/register">
                <button
                  class="mb-4 rounded-md bg-blue px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-blue/90 hover:shadow-none dark:bg-dark-blue dark:hover:bg-dark-blue/90"
                >
                  Create Your Personal Library
                </button>
              </Link>
            </div>
          </Transition>
        </header>
      </div>

      <main
        class="relative mt-4 flex flex-1 flex-col items-center justify-center overflow-hidden sm:mt-10"
      >
        <img
          class="absolute left-0 top-0 h-full w-full -rotate-2 rounded-lg object-cover opacity-80 drop-shadow-md"
          src="https://raw.githubusercontent.com/aileks/quillify/main/public/table.png"
          alt="table of books"
        />

        <div
          class="relative my-4 w-11/12 rounded-lg bg-bronze px-4 py-6 text-neutral-50 dark:bg-dark-bronze sm:my-10 sm:w-3/4 sm:px-8 sm:py-12"
        >
          <p class="px-2 font-medium sm:px-4 sm:text-lg">
            Quillify is your simple, elegant solution for tracking your reading
            journey. Effortlessly manage your book collection our searchable
            list and keep your reading goals on track.
          </p>

          <p class="mt-2 px-2 font-medium sm:mt-4 sm:px-4 sm:text-lg">
            Discover a more organized and enjoyable reading experience with
            Quillify.
          </p>

          <Link href="/register">
            <button
              class="relative mt-4 rounded-md bg-blue px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-blue/90 hover:shadow-none dark:bg-dark-blue dark:hover:bg-dark-blue/90 sm:mt-8"
            >
              Start Now!
            </button>
          </Link>
        </div>
      </main>
    </div>

    <footer
      class="absolute left-0 right-0 flex flex-col bg-tan text-sm text-neutral-800 dark:bg-dark-bronze dark:text-neutral-50"
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
