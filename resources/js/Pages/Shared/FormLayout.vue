<script setup>

</script>

<template>
  <div class="flex items-center justify-center h-screen">
    <div id="container"
         class="justify-center rounded-xl w-1/4 p-4 mb-2">
      <slot/>
    </div>
  </div>
</template>

<style scoped>
  #container {
    background-color: rgb(208, 173, 167);
  }
</style>