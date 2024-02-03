<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";
import genreData from "../../../data/genres.json";
import { useForm } from "@inertiajs/vue3";

defineProps({
  errors: Object,
});

const form = useForm({
  title: null,
  author: null,
  pages: null,
  genre: "",
  publishYear: "",
  read: false,
});

const genres = genreData.genres;
const reversedYears = Array.from(
  { length: new Date().getFullYear() - 1900 + 1 },
  (_, i) => i + 1900
).reverse();

const submit = () => {
  form.read = document.queryselector('input[name="read"]').checked;
  form.post("/books/add");
};
</script>

<template>
  <Head title="Add a Book" />

  <Layout>
    <FormLayout>
      <h1 id="box-text" class="text-3xl border-b border-bronze pb-1.5">
        Add Book
      </h1>

      <form method="POST" @submit.prevent="submit">
        <div class="text-md flex flex-col mt-4 space-y-1">
          <label class="text-left" for="title">Title</label>
          <input
            v-model="form.title"
            class="border-bronze text-left border rounded-md"
            name="title"
            placeholder="What's it called?"
            required
            type="text"
          />
          <div v-if="errors.title" class="error">{{ errors.title }}</div>
        </div>

        <div class="text-md flex flex-col mt-4 space-y-1">
          <label class="text-left" for="author">Author</label>
          <input
            v-model="form.author"
            class="border-bronze text-left border rounded-md"
            name="author"
            placeholder="Who wrote it?"
            required
            type="text"
          />
          <div v-if="errors.author" class="error">{{ errors.author }}</div>
        </div>

        <div class="text-md flex flex-col mt-4 space-y-2">
          <label class="text-left" for="pages">Pages</label>
          <input
            v-model="form.pages"
            class="border-bronze text-left border rounded-md"
            name="pages"
            placeholder="How many pages?"
            type="number"
            min="1"
            max="3000"
          />
          <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
        </div>

        <div class="text-md flex flex-col mt-4 space-y-2">
          <label class="text-left" for="genre">Genre</label>
          <select
            v-model="form.genre"
            class="border-bronze text-left border rounded-md"
            name="genre"
            placeholder="Genre"
            required
          >
            <option disabled value="">Please select a genre</option>
            <option v-for="(genre, index) in genres" :key="index">
              {{ genre }}
            </option>
          </select>
          <div v-if="errors.genre" class="error">{{ errors.genre }}</div>
        </div>

        <div class="text-md flex flex-col mt-4 space-y-2">
          <label class="text-left" for="publishYear">Publish Year</label>
          <select
            class="border-bronze text-left border rounded-md"
            v-model="form.publishYear"
            name="publishYear"
            required
          >
            <option disabled value="">Please select a year</option>
            <option
              v-for="year in new reversedYears()"
              :key="year"
              :value="year"
            >
              {{ year }}
            </option>
          </select>
          <div v-if="errors.year" class="error">{{ errors.year }}</div>
        </div>

        <div class="flex items-center justify-center my-6 space-x-6 text-lg">
          <label for="read">Read?</label>
          <input
            v-model="form.read"
            class="border-bronze text-left border rounded-md"
            name="read"
            type="checkbox"
          />
          <div v-if="errors.read" class="error">{{ errors.read }}</div>
        </div>

        <div class="mt-6 space-x-10">
          <StyledButton type="submit">Add</StyledButton>

          <StyledButton>
            <Link href="/books">Go Back</Link>
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
