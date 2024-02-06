<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
  books: Object,
  success: String,
});

let success = ref(props.success);

onMounted(() => {
  if (success) {
    setTimeout(() => {
      success.value = null;
    }, 3000);
  }
});

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
    },
  });
};

const isSearchActive = ref(false);

const updateSearch = debounce((value) => {
  isSearchActive.value = true;
  router.replace(`/books?search=${value}`);
}, 300);

const goToPage = (url) => {
  router.replace(url);
};

const pageNumbers = computed(() => {
  let numbers = [];

  for (let i = 1; i <= props.books.last_page; i++) {
    numbers.push(i);
  }

  return numbers;
});

</script>

<template>
  <Head title="Books" />

  <Layout>
    <div class="flex flex-col items-center">
      <input
        id="search"
        @input="updateSearch($event.target.value)"
        class="border-bronze font-lg rounded-md"
        placeholder="Search Books..."
        type="text"
      />
    </div>

    <main class="flex flex-col items-center mt-4">
      <div
        v-if="props.books.data"
        class="table-container shadow-paper rounded-md overflow-x-auto"
      >
        <h2 class="bg-brown text-neutral-50 text-2xl">Your Books</h2>

        <div
          v-if="isSearchActive && props.books.data.length === 0"
          class="bg-white mx-auto shadow-paper p-8"
        >
          <h2 class="mb-4 text-xl">No books found.</h2>
        </div>

        <table v-else class="table-auto w-full">
          <thead
            class="bg-bronze text-neutral-50 font-bold md:text-lg sm:text-base divide-x"
          >
            <th class="sm:w-auto md:w-auto">Title</th>
            <th class="sm:w-auto md:w-auto">Author</th>
            <th class="sm:w-auto md:w-auto">Genre</th>
            <th class="px-2 sm:w-auto md:w-auto">Read?</th>
            <th class="px-2 sm:w-auto md:w-auto">Pages</th>
            <th class="sm:w-auto md:w-auto">Modify</th>
          </thead>

          <tbody class="bg-white flex-1 divide-y divide-gray-200">
            <tr
              v-for="book in props.books.data"
              :key="props.books.data.id"
              class="divide-x"
            >
              <td class="title px-2 sm:w-auto md:w-auto" data-label="Title">
                <div class="italic">
                  {{ book.title }}
                </div>
              </td>

              <td class="px-2 sm:w-auto md:w-auto" data-label="Author">
                {{ book.author }}
              </td>
              <td class="px-2 sm:w-auto md:w-auto" data-label="Genre">
                {{ book.genre }}
              </td>
              <td class="px-2 sm:w-auto md:w-auto" data-label="Read">
                <span v-if="book.read">✔️</span>
              </td>
              <td class="px-2 sm:w-auto md:w-auto" data-label="Pages">
                {{ book.pages }}
              </td>
              <td class="px-2" data-label="Modify">
                <Link
                  :href="`/books/edit/${book.id}`"
                  class="text-blue hover:underline inline-block"
                >
                  Edit
                </Link>

                <p class="inline-block mx-1 px-0.5">|</p>

                <Link
                  href="#"
                  class="text-red hover:underline inline-block"
                  @click.prevent="deleteBook(book.id)"
                >
                  Delete
                </Link>
              </td>
            </tr>
          </tbody>
        </table>

        <div
          class="flex items-center justify-center py-1 text-neutral-50 bg-bronze"
        >
          <!--Previous-->
          <button
            :disabled="!books.prev_page_url"
            @click="goToPage(books.prev_page_url)"
            class="hover:text-brown mx-2 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="w-5 h-5"
            >
              <path
                fill-rule="evenodd"
                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                clip-rule="evenodd"
              />
            </svg>
          </button>

          <!--Page Numbers-->
          <span
            class="mx-2 text-lg"
            v-for="(number, index) in pageNumbers"
            :key="index"
          >
            <button
              :disabled="number === props.books.current_page"
              @click="goToPage(`/books?page=${number}`)"
              class="hover:text-brown text-sm"
            >
              {{ number }}
            </button>
          </span>

          <!--Next-->
          <button
            :disabled="!books.next_page_url"
            @click="goToPage(books.next_page_url)"
            class="hover:text-brown mx-2 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="w-5 h-5"
            >
              <path
                fill-rule="evenodd"
                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </div>
      </div>

      <div
        v-else-if="!props.books.data && !isSearchActive"
        class="bg-sandy mx-auto max-w-md shadow-paper p-8 rounded-md"
      >
        <h2 class="mb-4 text-2xl">You don't have any books yet.</h2>

        <Link class="hover:underline text-brown mt-4 text-xl" href="/books/add">
          Add a book!
        </Link>
      </div>
    </main>
  </Layout>

  <Transition
    enter-active-class="transition-opacity duration-700 ease-in-out"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
  >
    <div class="fixed bottom-0 right-0 m-6 bg-emerald-600 rounded-lg shadow-lg overflow-hidden max-w-xs" v-show="success" @click="success=null">
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
