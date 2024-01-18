<script setup>

</script>

<template>

  <form>
    <div class="flex flex-col space-y-2">
      <label for="title">Title</label>
      <input v-model="text"
             class="border border-slate-200 rounded-md p-2"
             name="title"
             placeholder="Title"
             type="text">
    </div>

    <div class="mt-4 flex flex-col space-y-2">
      <label for="author">Author</label>
      <input v-model="text"
             class="border border-slate-200 rounded-md p-2"
             name="author"
             placeholder="Author"
             type="text">
    </div>

    <div class="mt-4 flex flex-col space-y-2">
      <label for="pages">Pages</label>
      <input v-model="number"
             class="border border-slate-200 rounded-md p-2"
             name="pages"
             placeholder="Pages"
             type="number">
    </div>

    <div class="mt-4 flex flex-col space-y-2">
      <label for="genre">Genre</label>
      <input v-model="text"
             class="border border-slate-200 rounded-md p-2"
             name="genre"
             placeholder="Genre"
             type="text">
    </div>

    <div class="mt-4 flex flex-col space-y-2 mb-2">
      <label for="published_at">Publish Date</label>
      <input v-model="date"
             class="border border-slate-200 rounded-md p-2"
             name="publish_date"
             placeholder="Publish Date"
             type="date">
    </div>
  </form>
</template>

<style scoped>

</style>