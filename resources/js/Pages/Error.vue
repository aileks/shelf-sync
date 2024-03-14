<script setup>
defineProps({
  status: {
    type: Number,
    required: true,
  },
});
</script>

<template>
  <Head title="Uh oh!" />

  <div class="container mx-auto my-12 max-w-[600px] px-4 pt-8">
    <h1 class="mb-4 text-3xl font-bold">Error {{ status }}</h1>
    <p v-if="status === 404">The page you're looking for could not be found.</p>
    <p v-else-if="status === 403">
      You do not have permission to access this page.
    </p>
    <p v-else-if="status === 500">An internal server error occurred.</p>
    <p v-else>Something went wrong.</p>
    <Link href="/" class="font-semibold text-blue hover:underline"
      >Go back to home</Link
    >
  </div>
</template>
