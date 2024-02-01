<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
</script>

<template>
  <nav
    class="flex px-1 py-2 mx-2 mt-2 space-x-4 rounded-md bg-sandy shadow-paper"
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
