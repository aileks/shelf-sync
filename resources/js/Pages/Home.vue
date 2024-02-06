<script setup>
import { onMounted, ref } from "vue";

const animate = ref(false);

onMounted(() => {
  animate.value = true;
});
</script>

<template>
  <Head title="Your Personal Library" />

  <Layout>
    <div
      class="parallax overflow-hidden relative min-h-[600px] rounded-md bg-fixed bg-center bg-no-repeat bg-cover h-64"
    >
      <Transition
        enter-active-class="transition-opacity duration-1000 ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition-opacity duration-700 ease-in-out"
        leave-to-class="opacity-0"
      >
        <header
          v-show="animate"
          class="flex flex-col justify-center text-neutral-50 items-center h-full"
        >
          <div class="bg-black/50 rounded-md p-8 w-1/4">
            <h1 class="text-3xl font-bold">Welcome to Quillify!</h1>

            <h2 class="mt-8 pt-8 text-xl font-semibold">
              Your personal library.
            </h2>
          </div>
        </header>
      </Transition>
    </div>

    <div class="flex items-center text-lg justify-center">
      <footer class="absolute bottom-0 pb-1 mb-1">
        Made with 👩‍💻 by
        <Link
          href="https://github.com/aileks/quillify"
          class="hover:underline font-medium text-blue"
          >Aaliyah
        </Link>
      </footer>
    </div>
  </Layout>
</template>

<style scoped>
.parallax {
  background-image: url("/img/library.jpeg");
}
</style>
