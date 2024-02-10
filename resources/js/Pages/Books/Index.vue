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

let isMobile = ref(window.innerWidth <= 800);

const updateIsMobile = () => {
  isMobile.value = window.innerWidth <= 800;
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
        class="w-60 rounded-md border-bronze"
        placeholder="Search Books..."
        type="search"
      />
    </div>

    <div
      v-show="isMobile"
      id="mobile-table"
      class="mt-2 flex w-full flex-col items-center justify-center overflow-hidden rounded-md shadow-paper"
    >
      <h2 class="w-full bg-brown text-xl text-neutral-50">Your Books</h2>

      <ul class="w-full space-y-1 divide-y divide-neutral-400 bg-white">
        <li
          v-for="book in books.data"
          :key="book.id"
          class="mx-2 flex items-center py-4"
        >
          <div class="flex flex-grow flex-col space-y-1">
            <div class="flex-grow font-bold italic">
              {{ book.title }}
            </div>
            <div class="pt-2 text-sm font-semibold">
              {{ book.author }}
            </div>
            <div
              class="mt-2 flex items-center justify-center text-sm font-medium text-brown"
            >
              <span class="mx-2">{{ book.read ? "Read" : "Unread" }}</span>
              <span class="mx-2">{{ book.genre }}</span>
              <span class="mx-2">{{ book.publishYear }}</span>
              <span class="mx-2 whitespace-nowrap">{{ book.pages }} pgs</span>
            </div>
          </div>
          <div class="flex w-1/2 items-center justify-end font-semibold">
            <Link
              :href="`/books/edit/${book.id}`"
              class="mr-3 text-blue hover:underline"
            >
              Edit
            </Link>

            <Link
              class="text-red hover:underline"
              href="#"
              @click.prevent="deleteBook(book.id)"
            >
              Delete
            </Link>
          </div>
        </li>
      </ul>

      <!-- Pagination  -->
      <div
        class="flex w-full items-center justify-around bg-brown py-2 text-center"
      >
        <Component
          :is="books.prev_page_url ? 'Link' : 'span'"
          :href="books.prev_page_url"
          class="rounded-full border bg-neutral-50 px-4 py-1 text-center"
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

        <span class="self-center rounded-full border bg-neutral-50 px-3 py-1">
            {{ books.current_page }}
          </span>

        <Component
          :is="books.next_page_url ? 'Link' : 'span'"
          :href="books.next_page_url"
          class="self-center rounded-full border bg-neutral-50 px-4 py-1"
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
      v-show="!isMobile"
      id="desktop-table"
      class="mt-4 flex flex-col items-center"
    >
      <div
        v-if="books.data"
        class="table-container overflow-x-auto rounded-md shadow-paper"
      >
        <h2 class="bg-brown text-2xl text-neutral-50">Your Books</h2>

        <div
          v-if="isSearchActive && books.data.length === 0"
          class="mx-auto bg-white p-8 shadow-paper"
        >
          <h2 class="mb-4 text-xl">No books found.</h2>
        </div>

        <table v-else
               class="w-full table-auto">
          <thead
            class="divide-x bg-bronze text-lg font-bold text-neutral-50 sm:text-base md:text-lg"
          >
          <th class="px-2 sm:w-auto md:w-auto">Read?</th>
          <th class="px-2 sm:w-auto md:w-auto">Title</th>
          <th class="px-2 sm:w-auto md:w-auto">Author</th>
          <th class="px-2 sm:w-auto md:w-auto">Genre</th>
          <th class="px-2 sm:w-auto md:w-auto">Pages</th>
          <th class="px-2 sm:w-auto md:w-auto">Publish Year</th>
          <th class="px-2 sm:w-auto md:w-auto">Modify</th>
          </thead>

          <tbody class="flex-1 divide-y divide-gray-200 bg-white">
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

            <td
              class="title px-2 sm:w-auto sm:px-0 md:w-auto"
              data-label="Title"
            >
              <div class="italic">
                {{ book.title }}
              </div>
            </td>

            <td class="px-2 sm:w-auto sm:px-0 md:w-auto"
                data-label="Author">
              {{ book.author }}
            </td>

            <td class="px-2 sm:w-auto sm:px-0 md:w-auto"
                data-label="Genre">
              {{ book.genre }}
            </td>

            <td class="px-2 sm:w-auto sm:px-0 md:w-auto"
                data-label="Pages">
              {{ book.pages }}
            </td>

            <td
              class="px-2 sm:w-auto sm:px-0 md:w-auto"
              data-label="Publish Year"
            >
              {{ book.publishYear }}
            </td>

            <td
              :class="!isMobile ? 'space-x-2' : ''"
              class="px-2"
              data-label="Modify"
            >
              <Link
                :href="`/books/edit/${book.id}`"
                class="inline-block text-blue hover:underline"
              >
                Edit
              </Link>

              <Link
                class="inline-block text-red hover:underline"
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
        <div class="bg-brown py-2 text-neutral-50">
          <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in books.links"
            :class="
              (link.url ? '' : 'opacity-50', link.active ? 'font-bold' : '')
            "
            :href="link.url"
            class="mx-1 my-1 rounded-full border border-neutral-50 px-2 hover:bg-neutral-50 hover:text-black"
            v-html="link.label"
          />
        </div>
      </div>

      <div
        v-else-if="!books.data && !isSearchActive"
        class="mx-auto max-w-md rounded-md bg-sandy p-8 shadow-paper"
      >
        <h2 class="mb-4 text-2xl">You don't have any books yet.</h2>

        <Link class="mt-4 text-xl text-brown hover:underline"
              href="/books/add">
          Add a book!
        </Link>
      </div>
    </div>
  </Layout>

  <Transition
    enter-active-class="transition-opacity duration-200 ease-in-out"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
  >
    <div
      v-show="success"
      class="fixed bottom-0 right-0 m-6 max-w-xs overflow-hidden rounded-lg bg-emerald-600 shadow-lg"
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
