<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
</script>

<template>
  <nav class="flex mx-2 mt-2 space-x-4">
    <div class="mr-auto">
      <StyledButton>
        <Link href="/register"> Register </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/login"> Log In </Link>
      </StyledButton>

      <StyledButton>
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
