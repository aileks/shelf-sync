<script setup>
  import Form from '@/Shared/Form.vue'
</script>

<template>
  <Head title="Add a Book"/>

  <Layout>
    <div class="flex items-center justify-center h-screen">
      <div id="container"
           class="justify-center border-tea-rose bg-tea-rose rounded-xl w-1/3 p-4">
        <Form/>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
  #container {
    background-color: rgb(208, 173, 167);
  }
</style>