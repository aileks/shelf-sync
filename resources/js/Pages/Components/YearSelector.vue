<script setup>
import { ref, watch } from "vue";
import {
  Listbox,
  ListboxLabel,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
  modelValue: Number,
});

// Reversed years data
const reversedYears = Array.from(
  { length: new Date().getFullYear() - 1800 + 1 },
  (_, i) => i + 1800,
).reverse();

const emit = defineEmits(["update:modelValue"]);

let selectedYear = ref(props.modelValue);

watch(selectedYear, (newYear) => {
  emit("update:modelValue", newYear);
});
</script>

<template>
  <Listbox v-model="selectedYear">
    <ListboxLabel class="text-left" for="publishYear">
      Publish Year
    </ListboxLabel>
    <div class="relative mt-1">
      <ListboxButton
        class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-400 sm:text-sm"
      >
        <span
          :class="{ 'text-gray-500': !selectedYear }"
          class="block truncate text-base"
        >
          {{ selectedYear ? selectedYear : "When was it published" }}
        </span>
        <span
          class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
        >
          <ChevronUpDownIcon aria-hidden="true" class="h-5 w-5 text-gray-400" />
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
</template>
