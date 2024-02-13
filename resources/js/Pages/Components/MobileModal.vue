<script setup>
import { ref } from "vue";

defineProps({
  isMobile: Boolean,
  changeSort: Function,
});

const showMobileModal = ref(false);
const sortOptions = {
  Read: "read",
  Title: "title",
  Author: "author",
  Genre: "genre",
  Pages: "pages",
  Published: "publish_year",
  "Date Added": "created_at",
};
</script>

<template>
  <Teleport to="body">
    <div v-show="isMobile">
      <button
        @click="showMobileModal = true"
        class="rounded-md bg-brown px-3 py-1 text-neutral-50 shadow-paper"
      >
        Sort
      </button>

      <div
        v-show="showMobileModal"
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
          v-show="showMobileModal"
          class="fixed inset-0 z-10 overflow-y-auto"
          aria-labelledby="MobileModal-title"
          role="dialog"
          aria-MobileModal="true"
        >
          <div class="flex min-h-screen items-center justify-center px-4 pb-20">
            <div
              class="inline-block transform overflow-hidden rounded-lg text-left shadow-xl transition-all"
            >
              <div class="bg-primary px-4 pb-4 pt-5">
                <h3
                  class="text-xl font-medium leading-6 text-gray-900"
                  id="MobileModal-title"
                >
                  Sort Books By:
                </h3>

                <div class="mt-2">
                  <button
                    v-for="(value, key) in sortOptions"
                    :key="value"
                    @click="changeSort(value), (showMobileModal = false)"
                    class="m-2 rounded-md bg-brown px-3 py-1 text-neutral-50 shadow-paper"
                  >
                    {{ key }}
                  </button>
                </div>
              </div>

              <div class="flex justify-end bg-primary p-4">
                <button
                  @click="showMobileModal = false"
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
  </Teleport>
</template>
