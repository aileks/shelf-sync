<script setup>
</script>

<template>
  <Head title="Add a Book"/>

  <Layout>
    <div class="flex items-center justify-center h-screen">
      <div id="container"
           class="justify-center border-tea-rose bg-tea-rose rounded-xl w-1/3 p-4">
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
          <div class="mt-4 flex flex-col space-y-2">
            <label for="published_at">Publish Date</label>
            <input v-model="date"
                   class="border border-slate-200 rounded-md p-2"
                   name="published_at"
                   placeholder="Published At"
                   type="date">
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
  #container {
    background-color: rgb(208, 173, 167);
  }
</style>