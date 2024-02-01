<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
// import { ref } from "vue";

// const auth = ref($page.props.auth);
</script>

<template>
  <nav
    class="flex mx-2 mt-2 py-2 px-1 bg-sandy rounded-md space-x-4 shadow-[0_1px_1px_rgba(0,0,0,0.4)]"
  >
    <div class="mr-auto">
      <StyledButton v-show="!$page.props.auth.user">
        <Link href="/register"> Register </Link>
      </StyledButton>

      <StyledButton v-show="!$page.props.auth.user">
        <Link href="/login"> Log In </Link>
      </StyledButton>

      <StyledButton v-show="$page.props.auth.user">
        <Link as="button" href="/logout" method="post" type="button">
          Log Out
        </Link>
      </StyledButton>
    </div>

    <div class="ml-auto">
      <StyledButton v-show="$page.props.auth.user">
        <Link href="/books/add"> Add Book </Link>
      </StyledButton>

      <StyledButton v-show="$page.props.auth.user">
        <Link href="/books"> View Books </Link>
      </StyledButton>

      <StyledButton v-show="$page.props.auth.user">
        <Link href="/profile"> Profile </Link>
      </StyledButton>
    </div>
  </nav>
</template>
