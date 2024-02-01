<script setup>
import StyledButton from "./StyledButton.vue";

defineProps({
  submitText: String,
  cancelUrl: String,
});
</script>

<template>
  <div class="mt-8 space-x-12">
    <StyledButton class="bg-brown text-neutral-100" type="submit">
      {{ submitText }}
    </StyledButton>

    <StyledButton class="bg-brown text-neutral-100">
      <Link :href="cancelUrl"> Cancel </Link>
    </StyledButton>
  </div>
</template>
