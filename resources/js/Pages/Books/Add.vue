<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import StyledButton from "@/Components/StyledButton.vue";
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import GenreSelector from "@/Components/GenreSelector.vue";
import YearSelector from "@/Components/YearSelector.vue";

defineProps({
  errors: Object,
});

const form = useForm({
  title: null,
  author: null,
  pages: null,
  genre: "",
  publishYear: null,
  read: false,
});

let isProcessing = ref(false);

const submit = () => {
  // TODO: Find a better way to handle isProcessing value change
  isProcessing.value = true;
  form.post("/books/add");
  isProcessing.value = false;
};
</script>

<template>
  <!-- TODO: Clean up file -->

  <Head title="Add a Book" />

  <FormLayout>
    <h1 id="box-text" class="border-b border-bronze pb-1.5 text-3xl">
      Add Book
    </h1>

    <form method="POST" @submit.prevent="submit">
      <div class="text-md mt-4 flex flex-col space-y-1">
        <label class="text-left" for="title">Title</label>
        <input
          v-model="form.title"
          class="rounded-md border-none text-left"
          name="title"
          placeholder="What's it called?"
          required
          type="text"
        />
        <div v-if="errors.title" class="error">{{ errors.title }}</div>
      </div>

      <div class="text-md mt-4 flex flex-col space-y-1">
        <label class="text-left" for="author">Author</label>
        <input
          v-model="form.author"
          class="rounded-md border-none text-left"
          name="author"
          placeholder="Who wrote it?"
          required
          type="text"
        />
        <div v-if="errors.author" class="error">{{ errors.author }}</div>
      </div>

      <div class="text-md mt-4 flex flex-col space-y-2">
        <label class="text-left" for="pages">Pages</label>
        <input
          v-model="form.pages"
          class="rounded-md border-none text-left"
          max="3000"
          min="1"
          name="pages"
          placeholder="How many pages?"
          type="number"
        />
        <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
      </div>

      <!--Genres-->
      <div class="mt-4">
        <GenreSelector v-model="form.genre" />
        <div v-if="errors.genre" class="error">
          {{ errors.genre }}
        </div>
      </div>

      <!--Publish Year-->
      <div class="mt-4">
        <YearSelector v-model="form.publishYear" />
        <div v-if="errors.publishYear" class="error">
          {{ errors.publishYear }}
        </div>
      </div>

      <div class="my-6 flex items-center justify-center space-x-2 text-lg">
        <input
          v-model="form.read"
          class="rounded text-left"
          name="read"
          type="checkbox"
        />
        <label for="read">Read?</label>

        <div v-if="errors.read" class="error">{{ errors.read }}</div>
      </div>

      <div class="mt-6 flex justify-center space-x-8">
        <StyledButton type="submit" :isProcessing="isProcessing"
          >Add</StyledButton
        >

        <StyledButton>
          <Link href="/books">Go Back</Link>
        </StyledButton>
      </div>
    </form>
  </FormLayout>
</template>
