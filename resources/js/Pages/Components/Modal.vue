<script setup>
import { ref } from "vue";

defineProps({
  isMobile: Boolean,
  changeSort: Function,
});

const showModal = ref(false);
const sortOptions = {
  Read: "read",
  Title: "title",
  Author: "author",
  Genre: "genre",
  Pages: "pages",
  Published: "publishYear",
  "Date Added": "created_at",
};
</script>

<template>
  <div v-show="isMobile">
    <button
      @click="showModal = true"
      class="rounded-md bg-brown px-3 py-1 text-neutral-50 shadow-paper"
    >
      Sort
    </button>

    <div
      v-show="showModal"
      class="fixed inset-0 bg-neutral-800/80"
      aria-hidden="true"
    ></div>

    <Transition
      enter-active-class="transition-all duration-200 ease-in-out transform"
      leave-active-class="transition-all duration-150 ease-in-out transform"
      enter-from-class="scale-110 opacity-0"
      leave-to-class="scale-110 opacity-0"
    >
      <div
        v-show="showModal"
        class="fixed inset-0 z-10 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
      >
        <div class="flex min-h-screen items-center justify-center px-4 pb-20">
          <div
            class="inline-block transform overflow-hidden rounded-lg text-left shadow-xl transition-all"
          >
            <div class="bg-primary px-4 pb-4 pt-5">
              <h3
                class="text-xl font-medium leading-6 text-gray-900"
                id="modal-title"
              >
                Sort Books By:
              </h3>

              <div class="mt-2">
                <button
                  v-for="(value, key) in sortOptions"
                  :key="value"
                  @click="changeSort(value), (showModal = false)"
                  class="m-2 rounded-md bg-brown px-3 py-1 text-neutral-50 shadow-paper"
                >
                  {{ key }}
                </button>
              </div>
            </div>

            <div class="flex justify-end bg-primary p-4">
              <button
                @click="showModal = false"
                class="rounded-md bg-brown px-3 py-1 text-lg text-neutral-50 shadow-paper"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
