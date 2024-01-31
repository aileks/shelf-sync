<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import FormLayout from "../Shared/FormLayout.vue";
import Layout from "../Shared/Layout.vue";
import StyledButton from "../Shared/StyledButton.vue";
import genreData from "../../../data/genres.json";

const genres = genreData.genres;

const props = defineProps(["book"]);
const title = props.book.title;
const author = props.book.author;

const book = ref({
  ...props.book,
});

const saveBook = () => {
  book.value.read = document.querySelector('input[name="read"]').checked;
  if (!confirm("Are you ok with these changes?")) {
    return;
  }
  router.patch(`/books/edit`, {
    data: book.value,
  });
};
</script>

<template>
  <Head title="Edit Your Book" />

  <Layout>
    <FormLayout>
      <header class="border-b border-[#9d8461] mb-1 pb-1">
        <h2 id="box-text" class="text-lg">
          Editing:
          <span class="italic font-bold">
            {{ title }}
          </span>
        </h2>
        <h2 id="box-text" class="text-lg">
          By:
          <span class="font-bold">{{ author }}</span>
        </h2>
      </header>

      <form @submit.prevent="saveBook">
        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="title">Title</label>
          <input
            v-model="book.title"
            class="text-center border border-[#9d8461] rounded-md"
            name="title"
            placeholder="Title"
            required
            type="text"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="author">Author</label>
          <input
            v-model="book.author"
            class="text-center border border-[#9d8461] rounded-md"
            name="author"
            placeholder="Author"
            required
            type="text"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="pages">Pages</label>
          <input
            v-model="book.pages"
            class="text-center border border-[#9d8461] rounded-md"
            name="pages"
            placeholder="Pages"
            required
            type="number"
            min="1"
            max="1000"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="genre">Genre</label>
          <select
            v-model="book.genre"
            class="text-center border border-[#9d8461] rounded-md"
            name="genre"
            placeholder="Genre"
            required
            type="select"
          >
            <option v-for="(genre, index) in genres" :key="index">
              {{ genre }}
            </option>
          </select>
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="publishYear">Publish Year</label>
          <select
            class="text-center border border-[#9d8461] rounded-md"
            v-model="form.publishYear"
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
        </div>

        <div class="flex items-center justify-center mt-6 space-x-6 text-lg">
          <label for="read">Read</label>
          <input
            v-model="book.read"
            class="text-center border border-[#9d8461] rounded-md"
            name="read"
            type="checkbox"
          />
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
