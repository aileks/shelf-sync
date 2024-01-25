<script setup>
import StyledButton from "./StyledButton.vue";
</script>

<template>
  <div class="mt-8 space-x-12">
    <StyledButton type="submit"> Submit </StyledButton>

    <StyledButton>
      <Link href="/"> Cancel </Link>
    </StyledButton>
  </div>
</template>
