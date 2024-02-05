<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
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

const reversedYears = Array.from(
  { length: new Date().getFullYear() - 1800 + 1 },
  (_, i) => i + 1800,
).reverse();

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

  <FormLayout>
    <header class="border-bronze pb-1 mb-1 border-b">
      <h2 id="box-text" class="text-2xl">
        Editing:
        <span class="italic font-bold underline">
          {{ title }}
        </span>
      </h2>

      <h2 id="box-text" class="mt-2 text-xl">
        By:
        <span class="font-bold">{{ author }}</span>
      </h2>
    </header>

    <form @submit.prevent="saveBook">
      <div class="flex flex-col mt-4 space-y-1 text-lg">
        <label class="text-left" for="title">Title</label>
        <input
          v-model="book.title"
          class="border-bronze text-left border rounded-md"
          name="title"
          placeholder="Title"
          required
          type="text"
        />
        <div v-if="errors.title" class="error">{{ errors.title }}</div>
      </div>

      <div class="flex flex-col mt-4 space-y-1 text-lg">
        <label class="text-left" for="author">Author</label>
        <input
          v-model="book.author"
          class="border-bronze text-left border rounded-md"
          name="author"
          placeholder="Author"
          required
          type="text"
        />
        <div v-if="errors.author" class="error">{{ errors.author }}</div>
      </div>

      <div class="flex flex-col mt-4 space-y-1 text-lg">
        <label class="text-left" for="pages">Pages</label>
        <input
          v-model="book.pages"
          class="border-bronze text-left border rounded-md"
          name="pages"
          placeholder="Pages"
          type="number"
          min="1"
          max="3000"
        />
        <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
      </div>

      <div class="flex flex-col mt-4 space-y-1 text-lg">
        <label class="text-left" for="genre">Genre</label>
        <select
          v-model="book.genre"
          class="border-bronze text-left border rounded-md"
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

      <div class="flex flex-col mt-4 space-y-1 text-lg">
        <label class="text-left" for="publishYear">Publish Year</label>
        <select
          class="border-bronze text-left border rounded-md"
          v-model="book.publishYear"
          name="publishYear"
        >
          <option disabled value="">Please select a year</option>
          <option v-for="year in reversedYears" :key="year" :value="year">
            {{ year }}
          </option>
        </select>
        <div v-if="errors.year" class="error">{{ errors.year }}</div>
      </div>

      <div class="flex items-center justify-center my-6 space-x-6 text-lg">
        <label for="read">Read?</label>
        <input
          v-model="isRead"
          class="border-bronze text-left border rounded-md"
          name="read"
          type="checkbox"
        />
        <div v-if="errors.read" class="error">{{ errors.read }}</div>
      </div>

      <div class="flex justify-center mt-6 space-x-8">
        <StyledButton type="submit"> Save</StyledButton>

        <StyledButton>
          <Link href="/books"> Cancel</Link>
        </StyledButton>
      </div>
    </form>
  </FormLayout>
</template>

<style scoped>
.error {
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
