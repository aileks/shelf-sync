<script setup>
import { ref, onMounted } from "vue";

const animate = ref(false);

onMounted(() => {
  animate.value = true;
});
</script>

<template>
  <Head title="Your Personal Library" />

  <Layout>
    <Transition
      enter-active-class="transition-opacity duration-1000 ease-in-out"
      enter-from-class="opacity-0"
      leave-active-class="transition-opacity duration-700 ease-in-out"
      leave-to-class="opacity-0"
    >
      <header v-show="animate" class="flex flex-col mt-12">
        <h1 class="text-2xl">Welcome to Quillify!</h1>
        <h2 class="mt-2 text-xl">
          Keep track of all those books you don't read. ;)
        </h2>
      </header>
    </Transition>
  </Layout>
</template>
