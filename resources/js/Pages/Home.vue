<script setup>
  import StyledButton from "@/Shared/StyledButton.vue";
  import {usePage} from "@inertiajs/inertia-vue3";

  defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
  });

  const props = usePage();
  console.log(props);
</script>

<template>
  <Head title="Your Personal Library"/>

  <Layout>
    <p class="text-2xl">Welcome to Quillify!</p>
    <p class="text-xl mt-2">Keep track of all those books you don't read. ;)</p>

    <div class="flex justify-center space-x-4 mt-10">
      <StyledButton v-if="!$page.props.user">
        <Link href="/register">
          Register
        </Link>
      </StyledButton>

      <StyledButton v-if="!$page.props.user">
        <Link href="/login">
          Log In
        </Link>
      </StyledButton>

      <StyledButton v-if="$page.props.user">
        <Link as="button"
              href="/logout"
              method="post"
              type="button"
        >
          Log Out
        </Link>
      </StyledButton>

      <StyledButton v-if="$page.props.user">
        <Link href="/books/add">
          Add Book
        </Link>
      </StyledButton>

      <StyledButton v-if="!$page.props.user">
        <Link href="/books">
          View Books
        </Link>
      </StyledButton>
    </div>
  </Layout>
</template>
