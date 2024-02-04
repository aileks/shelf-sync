<script setup>
import StyledButton from "./StyledButton.vue";

defineProps({
  submitText: String,
  cancelUrl: String,
});
</script>

<template>
  <div class="flex justify-center mt-6 space-x-8">
    <StyledButton class="bg-brown text-neutral-100" type="submit">
      {{ submitText }}
    </StyledButton>

    <StyledButton class="bg-brown text-neutral-100">
      <Link :href="cancelUrl"> Cancel </Link>
    </StyledButton>
  </div>
</template>
