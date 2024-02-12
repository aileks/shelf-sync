<script setup>
import { ref, watch, computed } from "vue";
import genreData from "../../../data/genres.json";
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
  ComboboxLabel,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
  modelValue: String,
});

// Genre data
const genres = genreData.genres;
let genreQuery = ref("");
let filteredGenres = computed(() =>
  genreQuery.value === ""
    ? genres
    : genres.filter((genre) => {
        return genre.toLowerCase().includes(genreQuery.value.toLowerCase());
      }),
);

const emit = defineEmits(["update:modelValue"]);

let selectedGenre = ref(props.modelValue);

watch(selectedGenre, (newGenre) => {
  emit("update:modelValue", newGenre);
});
</script>

<template>
  <Combobox v-model="selectedGenre">
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
          <ChevronUpDownIcon aria-hidden="true" class="h-5 w-5 text-gray-400" />
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
</template>
