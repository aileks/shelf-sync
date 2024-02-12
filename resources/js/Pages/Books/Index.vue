<script setup>
import Modal from "@/Components/Modal.vue";
import { onMounted, onUnmounted, ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
  books: Object,
  success: String,
});

const books = ref(props.books);
const success = ref(props.success);
const isMobile = ref(window.innerWidth <= 800);
let clickCount = 0;

const sortBy = ref("");
const sortDirection = ref("asc");
const changeSort = (column) => {
  if (sortBy.value === column) {
    clickCount++;
    if (clickCount === 3) {
      sortBy.value = null;
      sortDirection.value = null;
      clickCount = 0;
    } else {
      sortDirection.value = sortDirection.value === "asc" ? "desc" : "asc";
    }
  } else {
    sortBy.value = column;
    sortDirection.value = "asc";
    clickCount = 1;
  }

  if (sortBy.value !== null && sortDirection.value !== null) {
    router.get(
      "/books",
      {
        sort_by: sortBy.value,
        sort_direction: sortDirection.value,
        page: books.value.current_page,
      },
      {
        preserveState: true,
        onSuccess: (page) => {
          books.value = page.props.books;
        },
      },
    );
  } else {
    router.get(
      "/books",
      {
        page: books.value.current_page,
      },
      {
        preserveState: true,
        onSuccess: (page) => {
          books.value = page.props.books;
        },
      },
    );
  }
};
const sortIcon = (column) => {
  if (sortBy.value !== column) {
    return "";
  }
  return sortDirection.value === "asc" ? "▲" : "▼";
};

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
    onSuccess: () => {
      router.get("/books", {
        page: books.value.current_page,
      });
    },
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
        },
      },
    );
  }, 300),
);

onMounted(() => {
  window.addEventListener("resize", updateIsMobile);

  if (success) {
    setTimeout(() => {
      success.value = null;
    }, 3000);
  }
});

onUnmounted(() => {
  window.removeEventListener("resize", updateIsMobile);
});
</script>

<template>
  <Head title="Books" />

  <Layout>
    <div class="flex items-center justify-around">
      <input
        id="search"
        v-model="search"
        class="rounded-md border-bronze sm:w-[80%] md:w-[60%] lg:w-60"
        placeholder="Search Books..."
        type="search"
      />
      <Modal :isMobile="isMobile" :changeSort="changeSort" />
    </div>

    <!-- TODO: Extract mobile and desktop views into separate components -->
    <!-- Mobile View -->
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
          <div class="flex w-full flex-grow flex-col space-y-1">
            <div
              class="flex flex-nowrap justify-center space-x-2 text-center font-bold italic"
            >
              <span v-show="book.read" class="mr-2">✔️</span>
              {{ book.title }}
            </div>

            <div class="py-1 font-semibold">
              {{ book.author }}
            </div>

            <div
              class="mt-2 flex items-center justify-around text-sm font-medium text-brown"
            >
              <span class="mx-2 whitespace-nowrap px-2">
                {{ book.pages }} pgs
              </span>
              <span class="mx-2 px-2">{{ book.publishYear }}</span>
              <span class="mx-2 whitespace-nowrap px-2">{{ book.genre }}</span>
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

      <!-- Mobile Pagination  -->
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

    <!-- Desktop View -->
    <div
      v-show="!isMobile"
      id="desktop-table"
      class="mt-4 flex flex-col items-center"
    >
      <div
        v-if="books.data"
        class="table-container overflow-hidden rounded-md shadow-paper"
      >
        <h2 class="bg-brown text-2xl text-neutral-50">Your Books</h2>

        <div
          v-if="isSearchActive && books.data.length === 0"
          class="bg-white p-8 shadow-paper"
        >
          <h2 class="text-xl">No books found.</h2>
        </div>

        <table v-else class="w-full max-w-screen-xl table-auto">
          <thead
            class="divide-x bg-bronze text-lg font-bold text-neutral-50 sm:text-base md:text-lg"
          >
            <th
              @click="changeSort('read')"
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("read") }}</span>
              Read?
            </th>
            <th
              @click="changeSort('title')"
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("title") }}</span>
              Title
            </th>
            <th
              @click="changeSort('author')"
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("author") }}</span>
              Author
            </th>
            <th
              @click="changeSort('genre')"
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("genre") }}</span>
              Genre
            </th>
            <th
              @click="changeSort('pages')"
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("pages") }}</span>
              Pages
            </th>
            <th
              @click="changeSort('publishYear')"
              class="px-2 sm:w-auto md:w-auto"
            >
              <span>{{ sortIcon("publishYear") }}</span>
              Published
            </th>
            <th class="px-2 sm:w-auto md:w-auto">Modify</th>
          </thead>

          <tbody class="flex-1 divide-y divide-gray-200 bg-white">
            <tr v-for="book in books.data" :key="book.id" class="divide-x">
              <td class="px-2 sm:w-auto md:w-auto" data-label="Read">
                <span v-if="book.read">✔️</span>
              </td>

              <td class="px-2 italic" data-label="Title">
                {{ book.title }}
              </td>

              <td class="px-2" data-label="Author">
                {{ book.author }}
              </td>

              <td class="px-2" data-label="Genre">
                {{ book.genre }}
              </td>

              <td data-label="Pages">
                {{ book.pages }}
              </td>

              <td data-label="Publish Year">
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

                <button
                  class="inline-block text-red hover:underline"
                  @click.prevent="deleteBook(book.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Desktop Pagination  -->
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

        <Link class="mt-4 text-xl text-brown hover:underline" href="/books/add">
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
      class="bg-green fixed bottom-0 right-0 m-6 max-w-xs overflow-hidden rounded-lg shadow-lg"
      @click="success = null"
    >
      <div class="p-4">
        <p class="text-neutral-50">{{ success }}</p>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
/** TODO: Change to tailwind classes */
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
</style>
