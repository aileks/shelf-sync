<template>
  <form>
    <div class="flex flex-col space-y-2">
      <label for="title">Title</label>
      <input id="title"
             class="border border-slate-200 rounded-md p-2"
             name="title"
             placeholder="Title"
             type="text">
    </div>
    <div class="mt-4 flex flex-col space-y-2">
      <label for="author">Author</label>
      <input id="author"
             class="border border-slate-200 rounded-md p-2"
             name="author"
             placeholder="Author"
             type="text">
    </div>
    <div class="mt-4 flex flex-col space-y-2">
      <label for="pages">Pages</label>
      <input id="pages"
             class="border border-slate-200 rounded-md p-2"
             name="pages"
             placeholder="Pages"
             type="number">
    </div>
    <div class="mt-4 flex flex-col space-y-2">
      <label for="genre">Genre</label>
      <input id="genre"
             class="border border-slate-200 rounded-md p-2"
             name="genre"
             placeholder="Genre"
             type="text">
    </div>
    <div class="mt-4 flex flex-col space-y-2">
      <label for="published_at">Publish Date</label>
      <input id="published_at"
             class="border border-slate-200 rounded-md p-2"
             name="published_at"
             placeholder="Published At"
             type="date">
    </div>
  </form>
</template>