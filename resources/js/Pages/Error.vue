<script setup>
defineProps({
  status: {
    type: Number,
    required: true
  }
});
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Error {{ status }}</h1>
    <p v-if="status === 404">The page you're looking for could not be found.</p>
    <p v-else-if="status === 403">You do not have permission to access this page.</p>
    <p v-else-if="status === 500">An internal server error occurred.</p>
    <p v-else>Something went wrong.</p>
    <Link href="/" class="text-blue font-semibold hover:underline">Go back to home</Link>
  </div>
</template>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}
</style>