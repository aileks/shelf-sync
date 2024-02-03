<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import FormLayout from "../Shared/FormLayout.vue";
import Layout from "../Shared/Layout.vue";
import StyledButton from "../Shared/StyledButton.vue";
import genreData from "../../../data/genres.json";

const genres = genreData.genres;

const props = defineProps({
  book: Object,
  errors: Object,
});
const title = props.book.title;
const author = props.book.author;

const book = ref({
  ...props.book,
});

const isRead = computed({
  get: () => Boolean(book.value.read),
  set: (value) => (book.value.read = value),
});

const saveBook = () => {
  book.value.read = document.querySelector('input[name="read"]').checked;

  router.patch(`/books/edit/${book.value.id}`, {
    data: book.value,
  });
};
</script>

<template>
  <Head title="Edit Your Book" />

  <Layout>
    <FormLayout>
      <header class="border-bronze pb-1 mb-1 border-b">
        <h2 id="box-text" class="text-xl">
          Editing:
          <span class="italic font-bold underline">
            {{ title }}
          </span>
        </h2>

        <h2 id="box-text" class="text-xl">
          By:
          <span class="font-bold">{{ author }}</span>
        </h2>
      </header>

      <form @submit.prevent="saveBook">
        <div class="flex flex-col mt-4 space-y-2 text-lg">
          <label for="title">Title</label>
          <input
            v-model="book.title"
            class="border-bronze text-center border rounded-md"
            name="title"
            placeholder="Title"
            required
            type="text"
          />
          <div v-if="errors.title" class="error">{{ errors.title }}</div>
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-lg">
          <label for="author">Author</label>
          <input
            v-model="book.author"
            class="border-bronze text-center border rounded-md"
            name="author"
            placeholder="Author"
            required
            type="text"
          />
          <div v-if="errors.author" class="error">{{ errors.author }}</div>
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-lg">
          <label for="pages">Pages</label>
          <input
            v-model="book.pages"
            class="border-bronze text-center border rounded-md"
            name="pages"
            placeholder="Pages"
            required
            type="number"
            min="1"
            max="3000"
          />
          <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-lg">
          <label for="genre">Genre</label>
          <select
            v-model="book.genre"
            class="border-bronze text-center border rounded-md"
            name="genre"
            placeholder="Genre"
            required
          >
            <option v-for="(genre, index) in genres" :key="index">
              {{ genre }}
            </option>
          </select>
          <div v-if="errors.genre" class="error">{{ errors.genre }}</div>
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-lg">
          <label for="publishYear">Publish Year</label>
          <select
            class="border-bronze text-center border rounded-md"
            v-model="book.publishYear"
            name="publishYear"
          >
            <option disabled value="">Please select a year</option>
            <option
              v-for="year in new Date().getFullYear() - 1900"
              :key="year"
              :value="year + 1900"
            >
              {{ year + 1900 }}
            </option>
          </select>
          <div v-if="errors.year" class="error">{{ errors.year }}</div>
        </div>

        <div class="flex items-center justify-center mt-6 space-x-6 text-lg">
          <label for="read">Read</label>
          <input
            v-model="isRead"
            class="border-bronze text-center border rounded-md"
            name="read"
            type="checkbox"
          />
          <div v-if="errors.read" class="error">{{ errors.read }}</div>
        </div>

        <div class="mt-5 space-x-10">
          <StyledButton type="submit"> Save </StyledButton>

          <StyledButton>
            <Link href="/books"> Cancel </Link>
          </StyledButton>
        </div>
      </form>
    </FormLayout>
  </Layout>
</template>

<style scoped>
.error {
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
