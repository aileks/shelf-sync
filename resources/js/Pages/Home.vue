<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import NavBar from "./Shared/NavBar.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});

const props = usePage();
console.log(props);
</script>

<template>
  <Head title="Your Personal Library" />

  <Layout>
    <header>
      <h1 class="text-2xl">Welcome to Quillify!</h1>
      <h2 class="mt-2 text-xl">
        Keep track of all those books you don't read. ;)
      </h2>
    </header>
  </Layout>
</template>
