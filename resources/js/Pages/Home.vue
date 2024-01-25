<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import { usePage } from "@inertiajs/inertia-vue3";

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

    <div class="flex justify-center mt-10 space-x-4">
      <StyledButton v-if="!$page.props.user">
        <Link href="/register"> Register </Link>
      </StyledButton>

      <StyledButton v-if="!$page.props.user">
        <Link href="/login"> Log In </Link>
      </StyledButton>

      <StyledButton v-if="$page.props.user">
        <Link as="button" href="/logout" method="post" type="button">
          Log Out
        </Link>
      </StyledButton>

      <StyledButton v-if="$page.props.user">
        <Link href="/books/add"> Add Book </Link>
      </StyledButton>

      <StyledButton v-if="!$page.props.user">
        <Link href="/books"> View Books </Link>
      </StyledButton>
    </div>
  </Layout>
</template>
