<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";
import { router } from "@inertiajs/vue3";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
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
          max="3000"
          min="1"
          name="pages"
          placeholder="Pages"
          type="number"
        />
        <div v-if="errors.pages" class="error">{{ errors.pages }}</div>
      </div>

      <!--Genres-->
      <div class="mt-4">
        <Combobox v-model="book.genre">
          <ComboboxLabel class="text-left" for="genre">Genre </ComboboxLabel>
          <div class="relative mt-1">
            <div
              class="relative w-full cursor-default overflow-hidden rounded-md bg-white text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-400 sm:text-sm"
            >
              <ComboboxInput
                class="w-full border-none py-2 pl-3 pr-10 text-md leading-5 focus:ring-0"
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
                class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm z-10"
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
      </div>

      <!--Publish Year-->
      <div class="mt-4">
        <Listbox v-model="book.publishYear">
          <ListboxLabel class="text-left" for="publishYear">
            Publish Year
          </ListboxLabel>
          <div class="relative mt-1">
            <ListboxButton
              class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-400 sm:text-sm"
            >
              <span
                :class="{ 'text-gray-500': !book.publishYear }"
                class="block text-base truncate"
              >
                {{
                  book.publishYear ? book.publishYear : "When was it published"
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
                      <CheckIcon aria-hidden="true" class="h-5 w-5" />
                    </span>
                  </li>
                </ListboxOption>
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
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
