<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed, ref, reactive } from "vue";
import StyledButton from "@/Components/StyledButton.vue";
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import genreData from "../../../data/genres.json";
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  Listbox,
  ListboxLabel,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
  TransitionRoot,
  ComboboxLabel,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

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

// Genre data for ComboBox
const genres = genreData.genres;
const genreQuery = ref("");
const filteredGenres = computed(() =>
  genreQuery.value === ""
    ? genres
    : genres.filter((genre) => {
        return genre.toLowerCase().includes(genreQuery.value.toLowerCase());
      }),
);

// Reversed years for ListBox
const reversedYears = Array.from(
  { length: new Date().getFullYear() - 1800 + 1 },
  (_, i) => i + 1800,
).reverse();

const submit = () => {
  isProcessing.value = true;
  form.post("/books/add");
  isProcessing.value = false;
};
</script>

<template>
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
        <Combobox v-model="form.genre">
          <ComboboxLabel class="text-left" for="genre">Genre </ComboboxLabel>
          <div class="relative mt-1">
            <div
              class="relative w-full cursor-default overflow-hidden rounded-md bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-400 sm:text-sm"
            >
              <ComboboxInput
                class="text-md w-full border-none py-2 pl-3 pr-10 leading-5 focus:ring-0"
                placeholder="What genre is it?"
                @change="genreQuery = $event.target.value"
              />
              <ComboboxButton
                class="absolute inset-y-0 right-0 flex items-center pr-2"
              >
                <ChevronUpDownIcon
                  aria-hidden="true"
                  class="h-5 w-5 text-gray-400"
                />
              </ComboboxButton>
            </div>

            <TransitionRoot
              leave="transition ease-in duration-100"
              leaveFrom="opacity-100"
              leaveTo="opacity-0"
              @after-leave="genreQuery = ''"
            >
              <ComboboxOptions
                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
              >
                <div
                  v-if="filteredGenres.length === 0 && genreQuery !== ''"
                  class="relative cursor-default select-none px-4 py-2 text-gray-700"
                >
                  Nothing found.
                </div>

                <ComboboxOption
                  v-for="genre in filteredGenres"
                  :key="genre.id"
                  v-slot="{ selected, active }"
                  :value="genre"
                  as="template"
                >
                  <li
                    :class="{
                      'bg-brown text-white': active,
                      'text-black': !active,
                    }"
                    class="relative cursor-default select-none py-2 pl-10 pr-4"
                  >
                    <span
                      :class="{
                        'font-medium': selected,
                        'font-normal': !selected,
                      }"
                      class="block truncate"
                    >
                      {{ genre }}
                    </span>
                    <span
                      v-if="selected"
                      :class="{
                        'text-white': active,
                        'text-blue': !active,
                      }"
                      class="absolute inset-y-0 left-0 flex items-center pl-3"
                    >
                      <CheckIcon aria-hidden="true" class="h-5 w-5" />
                    </span>
                  </li>
                </ComboboxOption>
              </ComboboxOptions>
            </TransitionRoot>
          </div>
        </Combobox>
        <div v-if="errors.genre" class="error">
          {{ errors.genre }}
        </div>
      </div>

      <!--Publish Year-->
      <div class="mt-4">
        <Listbox v-model="form.publishYear">
          <ListboxLabel class="text-left" for="publishYear">
            Publish Year
          </ListboxLabel>
          <div class="relative mt-1">
            <ListboxButton
              class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-400 sm:text-sm"
            >
              <span
                :class="{ 'text-gray-500': !form.publishYear }"
                class="block truncate text-base"
              >
                {{
                  form.publishYear ? form.publishYear : "When was it published"
                }}
              </span>
              <span
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
              >
                <ChevronUpDownIcon
                  aria-hidden="true"
                  class="h-5 w-5 text-gray-400"
                />
              </span>
            </ListboxButton>

            <transition
              leave-active-class="transition duration-100 ease-in"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <ListboxOptions
                class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
              >
                <ListboxOption
                  v-for="year in reversedYears"
                  :key="year.id"
                  v-slot="{ active, selected }"
                  :value="year"
                  as="template"
                >
                  <li
                    :class="[
                      active ? 'bg-brown text-neutral-50' : 'text-black',
                      'relative cursor-default select-none py-2 pl-10 pr-4',
                    ]"
                  >
                    <span
                      :class="[
                        selected ? 'font-medium' : 'font-normal',
                        'block truncate',
                      ]"
                      >{{ year }}</span
                    >
                    <span
                      v-if="selected"
                      class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue"
                    >
                      <CheckIcon
                        :class="{ 'text-neutral-50': active }"
                        aria-hidden="true"
                        class="h-5 w-5"
                      />
                    </span>
                  </li>
                </ListboxOption>
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
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

<style scoped></style>
