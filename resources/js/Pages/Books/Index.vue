<script setup>

  import StyledButton from "@/Shared/StyledButton.vue";
</script>

<template>
  <Head title="Your Books"/>
  <Layout>
    <h1 class="text-xl mb-4">Your books will show up here :)</h1>

    <StyledButton>
      <Link href="/">
        Home
      </Link>
    </StyledButton>
  </Layout>
</template>

<style scoped>

</style>