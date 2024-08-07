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
        class="gradient absolute inset-0 h-1/2 w-full rounded-md object-cover sm:h-full"
      />

      <div
        class="absolute inset-0 h-1/2 rounded-md bg-gradient-to-r from-neutral-900/85 to-neutral-800/85 sm:h-full"
      ></div>

      <Transition
        enter-active-class="transition-opacity duration-1000 ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition-opacity duration-700 ease-in-out"
        leave-to-class="opacity-0"
      >
        <header
          v-show="animate"
          class="flex h-1/2 w-full flex-col items-center justify-center text-neutral-50 sm:h-full"
        >
          <div class="relative z-10">
            <h1 class="my-4 text-2xl font-bold sm:text-5xl">
              Organize Your Reading Life with Quillify
            </h1>

            <p class="my-12 text-lg sm:text-2xl">
              Track and share your literary journey
            </p>
          </div>
        </header>
      </Transition>
    </div>

    <main class="flex flex-col items-center justify-center">
      <div class="mb-6 mt-10 rounded-md bg-sandy px-8 py-12">
        <p class="mx-10 px-10 text-base font-medium sm:text-lg">
          Quillify is your simple, elegant solution for tracking your reading
          journey. Effortlessly manage your book collection with our searchable
          list and keep your reading goals on track. Discover a more organized
          and enjoyable reading experience with Quillify.
        </p>
        <Link href="/register">
          <button
            class="mt-12 rounded-md bg-green px-4 py-2 font-bold text-white shadow-paper transition-all duration-300 hover:bg-green/90 hover:shadow-none"
          >
            Create Your Free Library!
          </button>
        </Link>
      </div>
    </main>

    <footer class="flex justify-center">
      <span
        class="absolute bottom-10 mt-2 flex items-center justify-center text-center text-sm sm:flex-wrap"
      >
        <div class="flex flex-wrap justify-center">
          Please report any issues on&nbsp;
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

      <div class="absolute bottom-0 mb-1 pb-1 text-sm">
        <p class="text-center">
          &copy; 2024 Aaliyah Harper. All rights reserved.
        </p>
      </div>
    </footer>
  </Layout>
</template>
