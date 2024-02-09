<script setup>
import { onMounted, onUnmounted, ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
  books: Object,
  success: String
});

let books = ref(props.books);
let success = ref(props.success);

let isMobile = ref(window.innerWidth <= 640);

const updateIsMobile = () => {
  isMobile.value = window.innerWidth <= 640;
};

const deleteBook = (id) => {
  router.delete(`/books/${id}`, {
    onBefore: () => {
      if (!confirm("Are you sure you want to delete this book?")) {
        return false;
      }
    },
    onSuccess: (page) => {
      success.value = "Book successfully deleted.";
      setTimeout(() => {
        success.value = null;
      }, 3000);
    }
  });
};

// Search functionality
let search = ref("");
let isSearchActive = ref(false);
watch(
  search,
  debounce((value) => {
    router.get(
      "/books",
      { search: value },
      {
        preserveState: true,
        onSuccess: (page) => {
          books.value = page.props.books;
          isSearchActive.value = true;
        }
      }
    );
  }, 300)
);

onMounted(() => {
  window.addEventListener("resize", updateIsMobile);

  if (success) {
    setTimeout(() => {
      success.value = null;
    }, 5000);
  }
});

onUnmounted(() => {
  window.removeEventListener("resize", updateIsMobile);
});
</script>

<template>
  <Head title="Books" />

  <Layout>
    <div class="flex justify-center">
      <input
        id="search"
        v-model="search"
        class="border-bronze rounded-md w-60"
        placeholder="Search Books..."
        type="search"
      />
    </div>

    <main class="flex flex-col items-center mt-4">
      <div
        v-if="books.data"
        class="table-container shadow-paper rounded-md overflow-x-auto"
      >
        <h2 class="bg-brown text-neutral-50 text-2xl">Your Books</h2>

        <div
          v-if="isSearchActive && books.data.length === 0"
          class="bg-white mx-auto shadow-paper p-8"
        >
          <h2 class="mb-4 text-xl">No books found.</h2>
        </div>

        <table v-else
               class="table-auto w-full">
          <thead
            class="bg-bronze text-neutral-50 font-bold text-lg md:text-lg sm:text-base divide-x"
          >
          <th class="px-2 sm:w-auto md:w-auto">Read?</th>
          <th class="px-2 sm:w-auto md:w-auto">Title</th>
          <th class="px-2 sm:w-auto md:w-auto">Author</th>
          <th class="px-2 sm:w-auto md:w-auto">Genre</th>
          <th class="px-2 sm:w-auto md:w-auto">Pages</th>
          <th class="px-2 sm:w-auto md:w-auto">Publish Year</th>
          <th class="px-2 sm:w-auto md:w-auto">Modify</th>
          </thead>

          <tbody class="bg-white flex-1 divide-y divide-gray-200">
          <tr v-for="book in books.data"
              :key="book.id"
              class="divide-x">
            <td class="px-2 sm:w-auto md:w-auto"
                data-label="Read">
                <span v-if="isMobile && book.read"
                      class="font-semibold"
                >Read️</span
                >
              <span v-else-if="isMobile && !book.read"
                    class="font-semibold">
                  Unread️
                </span>
              <span v-else-if="book.read">✔️</span>
            </td>

            <td class="title px-2 sm:w-auto md:w-auto"
                data-label="Title">
              <div class="italic">
                {{ book.title }}
              </div>
            </td>

            <td class="px-2 sm:w-auto md:w-auto"
                data-label="Author">
              {{ book.author }}
            </td>

            <td class="px-2 sm:w-auto md:w-auto"
                data-label="Genre">
              {{ book.genre }}
            </td>

            <td class="px-2 sm:w-auto md:w-auto"
                data-label="Pages">
              {{ book.pages }}
            </td>

            <td class="px-2 sm:w-auto md:w-auto"
                data-label="Publish Year">
              {{ book.publishYear }}
            </td>

            <td class="px-2"
                data-label="Modify">
              <Link
                :href="`/books/edit/${book.id}`"
                class="text-blue hover:underline inline-block"
              >
                Edit
              </Link>

              <p class="inline-block mx-1 px-0.5">|</p>

              <Link
                class="text-red hover:underline inline-block"
                href="#"
                @click.prevent="deleteBook(book.id)"
              >
                Delete
              </Link>
            </td>
          </tr>
          </tbody>
        </table>

        <!-- Pagination  -->
        <div v-if="!isMobile"
             class="py-2 bg-brown text-neutral-50">
          <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in books.links"
            :class="
              (link.url ? '' : 'opacity-50', link.active ? 'font-bold' : '')
            "
            :href="link.url"
            class="px-2 mx-1 my-1 border border-neutral-50 rounded-full hover:bg-neutral-50 hover:text-black"
            v-html="link.label"
          />
        </div>

        <div
          v-else
          class="py-2 bg-brown flex text-center items-center justify-around"
        >
          <Component
            :is="books.prev_page_url ? 'Link' : 'span'"
            :href="books.prev_page_url"
            class="px-4 py-1 bg-neutral-50 text-center border rounded-full"
          >
            <svg
              class="bi bi-chevron-double-left"
              fill="currentColor"
              height="16"
              viewBox="0 0 16 16"
              width="16"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"
                fill-rule="evenodd"
              />
              <path
                d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"
                fill-rule="evenodd"
              />
            </svg>
          </Component>

          <span class="px-3 py-1 bg-neutral-50 self-center border rounded-full">
            {{ books.current_page }}
          </span>

          <Component
            :is="books.next_page_url ? 'Link' : 'span'"
            :href="books.next_page_url"
            class="px-4 py-1 bg-neutral-50 self-center border rounded-full"
          >
            <svg
              class="bi bi-chevron-double-right"
              fill="currentColor"
              height="16"
              viewBox="0 0 16 16"
              width="16"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"
                fill-rule="evenodd"
              />
              <path
                d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"
                fill-rule="evenodd"
              />
            </svg>
          </Component>
        </div>
      </div>

      <div
        v-else-if="!books.data && !isSearchActive"
        class="bg-sandy mx-auto max-w-md shadow-paper p-8 rounded-md"
      >
        <h2 class="mb-4 text-2xl">You don't have any books yet.</h2>

        <Link class="hover:underline text-brown mt-4 text-xl"
              href="/books/add">
          Add a book!
        </Link>
      </div>
    </main>
  </Layout>

  <Transition
    enter-active-class="transition-opacity duration-200 ease-in-out"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
  >
    <div
      v-show="success"
      class="fixed bottom-0 right-0 m-6 bg-emerald-600 rounded-lg shadow-lg overflow-hidden max-w-xs"
      @click="success = null"
    >
      <div class="p-4">
        <p class="text-neutral-50">{{ success }}</p>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
#search {
  position: relative;
  padding-left: 32px;
  padding-top: 8px;
  background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="gray" class="w-2 h-2"%3E%3Cpath fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /%3E%3C/svg%3E');
  background-repeat: no-repeat;
  background-position: left 10px center;
  background-size: 18px 18px;
  max-width: 600px;
}

@media (max-width: 640px) {
  #search {
    width: 80%;
  }

  .table-container {
    width: 100%;
  }

  .table-auto thead {
    display: none;
  }

  .table-auto tr {
    margin-bottom: 1rem;
    display: block;
  }

  .table-auto td {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.8rem;
    word-wrap: break-word;
  }

  .table-auto td:before {
    flex-basis: 0;
  }

  .title {
    font-weight: bold;
  }
}
</style>
