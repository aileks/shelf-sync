<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";
import genreData from "../../../data/genres.json";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  title: null,
  author: null,
  pages: null,
  genre: "",
  publishYear: "",
  read: false,
});

const genres = genreData.genres;

const submit = () => {
  form.read = document.querySelector('input[name="read"]').checked;
  form.post("/books/add");
};
</script>

<template>
  <Head title="Add a Book" />

  <Layout>
    <FormLayout>
      <h1 id="box-text" class="text-xl border-b border-[#9d8461] pb-1.5">
        Add Book
      </h1>

      <form method="POST" @submit.prevent="submit">
        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="title">Title</label>
          <input
            v-model="form.title"
            class="text-center border border-[#9d8461] rounded-md"
            name="title"
            placeholder="What's it called?"
            required
            type="text"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="author">Author</label>
          <input
            v-model="form.author"
            class="text-center border border-[#9d8461] rounded-md"
            name="author"
            placeholder="Who wrote it?"
            required
            type="text"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="pages">Pages</label>
          <input
            v-model="form.pages"
            class="text-center border border-[#9d8461] rounded-md"
            name="pages"
            placeholder="How many pages?"
            required
            type="number"
            min="1"
            max="1000"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="genre">Genre</label>
          <select
            v-model="form.genre"
            class="text-center border border-[#9d8461] rounded-md"
            name="genre"
            placeholder="Genre"
            required
          >
            <option disabled value="">Please select a genre</option>
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
            required
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
            v-model="form.read"
            class="text-center border border-[#9d8461] rounded-md"
            name="read"
            type="checkbox"
          />
        </div>

        <div class="mt-5 space-x-10">
          <StyledButton type="submit"> Add </StyledButton>

          <StyledButton>
            <Link href="/books"> Go Back </Link>
          </StyledButton>
        </div>
      </form>
    </FormLayout>
  </Layout>
</template>

<style scoped></style>
