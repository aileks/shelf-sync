<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
import GenreSelector from "@/Components/GenreSelector.vue";
import YearSelector from "@/Components/YearSelector.vue";

let isProcessing = ref(false);

const props = defineProps({
  book: Object,
  errors: Object,
});

const title = props.book.title;
const author = props.book.author;

const form = useForm({
  ...props.book,
  read: Boolean(props.book.read),
  finished: Boolean(props.book.finished),
});

const reversedYears = Array.from(
  { length: new Date().getFullYear() - 1800 + 1 },
  (_, i) => i + 1800,
).reverse();

const saveBook = () => {
  // TODO: Find a better way to handle isProcessing value change
  isProcessing.value = true;
  form.patch(`/books/edit/${form.id}`);
  isProcessing.value = false;
};
</script>

<template>
  <!-- TODO: Clean up file -->

  <Head title="Edit Your Book" />

  <FormLayout>
    <header class="mb-1 border-b border-bronze pb-1">
      <h2 id="box-text" class="text-2xl">
        Editing:
        <span class="font-bold italic underline">
          {{ title }}
        </span>
      </h2>

      <h2 id="box-text" class="mt-2 text-xl">
        By:
        <span class="font-bold">{{ author }}</span>
      </h2>
    </header>

    <form @submit.prevent="saveBook">
      <div class="mt-4 flex flex-col space-y-1 text-lg">
        <label class="text-left" for="title">Title</label>
        <input
          v-model="form.title"
          class="rounded-md border border-bronze text-left"
          name="title"
          placeholder="Title"
          required
          type="text"
        />
        <div v-if="errors.title" class="error">{{ errors.title }}</div>
      </div>

      <div class="mt-4 flex flex-col space-y-1 text-lg">
        <label class="text-left" for="author">Author</label>
        <input
          v-model="form.author"
          class="rounded-md border border-bronze text-left"
          name="author"
          placeholder="Author"
          required
          type="text"
        />
        <div v-if="errors.author" class="error">{{ errors.author }}</div>
      </div>

      <div class="mt-4 flex flex-col space-y-1 text-lg">
        <label class="text-left" for="pages">Pages</label>
        <input
          v-model="form.pages"
          class="rounded-md border border-bronze text-left"
          max="3000"
          min="1"
          name="pages"
          placeholder="Pages"
          type="number"
        />
        <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
      </div>

      <!-- TODO: Extract component -->
      <!--Genres-->
      <div class="mt-4">
        <GenreSelector v-model="form.genre" />
        <div v-if="errors.genre" class="error">{{ errors.genre }}</div>
      </div>

      <!--Publish Year-->
      <div class="mt-4">
        <YearSelector v-model="form.publish_year" />
        <div v-if="errors.publish_year" class="error">
          {{ errors.publish_year }}
        </div>
      </div>

      <!-- Read status -->
      <div
        class="mb-4 mt-6 flex flex-col items-center justify-center space-y-2 text-lg"
      >
        <div class="flex items-center justify-center">
          <input
            v-model="form.read"
            class="mr-1 rounded text-left"
            name="read"
            type="checkbox"
          />

          <label for="read">Read?</label>
        </div>

        <div v-if="form.read" class="flex items-center">
          <input
            v-model="form.finished"
            class="mr-1 rounded text-left"
            name="finished"
            type="checkbox"
          />
          <label for="finished">Finished?</label>
        </div>

        <div v-if="errors.read" class="error">{{ errors.read }}</div>
      </div>

      <!-- Conditional based on read status -->
      <div
        v-if="form.finished"
        class="flex flex-col items-center justify-center"
      >
        <label class="mb-2 text-center" for="date_read">
          When did you finish it?
        </label>

        <input
          v-model="form.date_read"
          class="mb-4 w-60 rounded-md border-none"
          name="date_read"
          type="date"
        />

        <div v-if="errors.date_read" class="error">{{ errors.dateRead }}</div>
      </div>

      <div class="mt-6 flex justify-center space-x-8">
        <StyledButton :isProcessing="isProcessing" type="submit">
          Save
        </StyledButton>

        <StyledButton>
          <Link href="/books">Cancel</Link>
        </StyledButton>
      </div>
    </form>
  </FormLayout>
</template>

<style scoped></style>
