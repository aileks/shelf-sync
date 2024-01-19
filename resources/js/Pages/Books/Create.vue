<script setup>
import StyledButton from '@/Shared/StyledButton.vue';
import Form from '@/Shared/Form.vue';
import FormLayout from '@/Shared/FormLayout.vue';
import {useForm} from '@inertiajs/vue3';

const form = useForm({
  title: null,
  author: null,
  pages: null,
  genre: null,
  publishDate: null,
  read: null,
});

const submit = () => {
  form.post('/books');
}
</script>

<template>
  <Head title="Add a Book"/>

  <Layout>
    <FormLayout>
      <h1 id="box-text"
          class="text-xl border-b pb-1.5">Add Book</h1>

      <form @submit.prevent="submit">
        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="title">Title</label>
          <input v-model="form.title"
                 class="border border-slate-200 rounded-md text-center"
                 name="title"
                 placeholder="Title"
                 required
                 type="text"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="author">Author</label>
          <input v-model="form.author"
                 class="border border-slate-200 rounded-md text-center"
                 name="author"
                 placeholder="Author"
                 required
                 type="text"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="pages">Pages</label>
          <input v-model="form.pages"
                 class="border border-slate-200 rounded-md text-center"
                 name="pages"
                 placeholder="Pages"
                 required
                 type="number"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="genre">Genre</label>
          <input v-model="form.genre"
                 class="border border-slate-200 rounded-md text-center"
                 name="genre"
                 placeholder="Genre"
                 required
                 type="text"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="publishDate">Publish Date</label>
          <input v-model="form.publishDate"
                 class="border border-slate-200 rounded-md text-center"
                 name="publishDate"
                 placeholder="Publish Date"
                 required
                 type="date"
          />
        </div>

        <div class="mt-6 flex space-x-6 justify-center items-center text-lg">
          <label for="read">Read/Unread</label>
          <input v-model="form.read"
                 class="border border-slate-200 rounded-md text-center"
                 name="read"
                 required
                 type="checkbox"
          />
        </div>

        <div class="space-x-10 mt-5">
          <StyledButton id="form-button"
                        type="submit">
            Submit
          </StyledButton>

          <StyledButton id="form-button">
            <Link href="/">
              Cancel
            </Link>
          </StyledButton>
        </div>
      </form>

    </FormLayout>
  </Layout>
</template>

<style scoped>
#box-text {
  border-color: rgb(232, 214, 203);
}
</style>
