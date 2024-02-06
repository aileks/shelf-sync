<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted, onUnmounted, ref } from "vue";
import StyledButton from "@/Components/StyledButton.vue";
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import genreData from "../../../data/genres.json";

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
  { length: new Date().getFullYear() - 1800 + 1 },
  (_, i) => i + 1800,
).reverse();

const showGenresDropdown = ref(false);
const showYearDropdown = ref(false);
const genresContainer = ref(null);
const publishYearContainer = ref(null);

const closeDropdowns = (event) => {
  if (genresContainer.value && !genresContainer.value.contains(event.target)) {
    showGenresDropdown.value = false;
  }

  if (
    publishYearContainer.value &&
    !publishYearContainer.value.contains(event.target)
  ) {
    showYearDropdown.value = false;
  }
};

onMounted(() => {
  document.addEventListener("click", closeDropdowns);
});

onUnmounted(() => {
  document.removeEventListener("click", closeDropdowns);
});

const submit = () => {
  form.read = document.querySelector('input[name="read"]').checked;
  form.post("/books/add");
};
</script>

<template>
  <Head title="Add a Book" />

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

      <!--Genres-->
      <div class="flex flex-col mt-4 space-y-2" ref="genresContainer">
        <label class="text-left" for="genre">Genre</label>
        <div class="relative mt-2">
          <button
            @click="showGenresDropdown = !showGenresDropdown"
            type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-neutral-800 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
            aria-haspopup="listbox"
            aria-expanded="true"
            aria-labelledby="listbox-label"
          >
            <span class="flex items-center">
              <span class="ml-3 block truncate text-base">
                {{ form.genre || "Whats the genre?" }}
              </span>
            </span>
            <span
              class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2"
            >
            </span>
          </button>
          <ul
            v-show="showGenresDropdown"
            class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            tabindex="-1"
            role="listbox"
            aria-labelledby="listbox-label"
          >
            <li
              v-for="genre in genres"
              :key="genre"
              class="text-neutral-800 relative cursor-default select-none py-2 pl-3 pr-9"
              role="option"
              @click="
                form.genre = genre;
                showGenresDropdown = false;
              "
            >
              <div class="flex items-center rounded-md py-1 hover:bg-primary">
                <span class="font-normal ml-3 block truncate">{{ genre }}</span>
              </div>
              <span
                v-if="form.genre === genre"
                class="text-neutral-600 absolute inset-y-0 right-0 flex items-center pr-4"
              >
              </span>
            </li>
          </ul>
        </div>
      </div>

      <!--Publish Year-->
      <div class="flex flex-col mt-4 space-y-2" ref="publishYearContainer">
        <label class="text-left" for="publishYear">Publish Year</label>
        <div class="relative mt-2">
          <button
            @click="showYearDropdown = !showYearDropdown"
            type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-neutral-800 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
            aria-haspopup="listbox"
            aria-expanded="true"
            aria-labelledby="listbox-label"
          >
            <span class="flex items-center">
              <span class="ml-3 block truncate text-base">
                {{ form.publishYear || "When was it published?" }}
              </span>
            </span>
            <span
              class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2"
            >
            </span>
          </button>
          <ul
            v-show="showYearDropdown"
            class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            tabindex="-1"
            role="listbox"
            aria-labelledby="listbox-label"
          >
            <li
              v-for="year in reversedYears"
              :key="year"
              class="text-neutral-800 relative cursor-default py-2 pl-3 pr-9"
              role="option"
              @click="
                form.publishYear = year;
                showYearDropdown = false;
              "
            >
              <div class="flex items-center rounded-md py-1 hover:bg-primary">
                <span class="font-normal ml-3 block truncate">{{ year }}</span>
              </div>
              <span
                v-if="form.publishYear === year"
                class="text-neutral-600 absolute inset-y-0 right-0 flex items-center pr-4"
              >
              </span>
            </li>
          </ul>
        </div>
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

      <div class="flex justify-center mt-6 space-x-8">
        <StyledButton type="submit">Add</StyledButton>

        <StyledButton>
          <Link href="/books">Go Back</Link>
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
