<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import { computed } from "vue";

const isLoggedIn = computed(() => {
  // Replace this with your actual login check logic
  return true; // Assuming the user is logged in
});
</script>

<template>
  <nav class="flex mx-2 mt-2 space-x-4">
    <div class="mr-auto">
      <StyledButton v-if="!isLoggedIn.value">
        <Link href="/register"> Register </Link>
      </StyledButton>

      <StyledButton v-if="!isLoggedIn.value">
        <Link href="/login"> Log In </Link>
      </StyledButton>

      <StyledButton v-if="isLoggedIn.value">
        <Link as="button" href="/logout" method="post" type="button">
          Log Out
        </Link>
      </StyledButton>
    </div>

    <div class="ml-auto">
      <StyledButton>
        <Link href="/books/add"> Add Book </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/books"> View Books </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/profile"> Profile </Link>
      </StyledButton>
    </div>
  </nav>
</template>
