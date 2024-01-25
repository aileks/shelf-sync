<script setup>
import StyledButton from "./StyledButton.vue";
</script>

<template>
  <div class="mt-8 space-x-12">
    <StyledButton class="bg-[#69442e] text-neutral-100" type="submit">
      Submit
    </StyledButton>

    <StyledButton class="bg-[#69442e] text-neutral-100">
      <Link href="/"> Cancel </Link>
    </StyledButton>
  </div>
</template>
