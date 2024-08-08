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
    <div class="min-h-screen">
      <div
        class="relative z-0 flex w-auto flex-1 flex-col items-center justify-between"
      >
        <img
          class="absolute inset-0 w-full rounded-md object-cover sm:h-full"
          src="https://raw.githubusercontent.com/aileks/quillify/main/public/library.jpeg"
        />

        <!-- <div -->
        <!--   class="absolute inset-0 h-full rounded-md bg-gradient-to-r from-gray-900/80 to-gray-800/80 sm:h-full" -->
        <!-- ></div> -->

        <header
          class="text-shadow text-overlay z-10 mb-12 ml-4 mr-3 mt-2 flex flex-col items-center justify-center place-self-center self-center rounded-md py-4 text-neutral-50 sm:mb-2 sm:py-0"
        >
          <Transition
            enter-active-class="transition-opacity duration-1000 ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition-opacity duration-700 ease-in-out"
            leave-to-class="opacity-0"
          >
            <div v-show="animate" class="z-10 h-full w-full px-4 text-center">
              <h1
                class="my-2 text-xl font-bold sm:my-4 sm:text-2xl md:text-4xl"
              >
                Organize Your Reading Life With Quillify
              </h1>

              <p class="my-6 pt-4 text-base sm:my-12 sm:text-lg md:text-2xl">
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
