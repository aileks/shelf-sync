<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
  books: Object,
  filters: Object,
});

const deleteBook = (id) => {
  router.delete(`/books/${id}`, {
    onBefore: () => {
      if (!confirm("Are you sure you want to delete this book?")) {
        return false;
      }
    },
  });
};

const search = ref(props.filters ? props.filters.search : "");
const filteredBooks = computed(() => {
  if (!search.value) return props.books.data;
  return props.books.data.filter(
    (book) =>
      book.title.toLowerCase().includes(search.value.toLowerCase()) ||
      book.author.toLowerCase().includes(search.value.toLowerCase()),
  );
});
const searchActive = computed(() => search.value !== "");

const updateSearch = debounce((value) => {
  search.value = value;
}, 300);

const goToPage = (url) => {
  router.replace(url);
};

const pageNumbers = computed(() => {
  let numbers = [];

  for (let i = 1; i <= props.books.last_page; i++) {
    if (
      i === 1 ||
      i === 2 ||
      i === props.books.last_page ||
      i === props.books.last_page - 1 ||
      i === props.books.last_page - 2 ||
      (i >= props.books.current_page - 1 && i <= props.books.current_page + 1)
    ) {
      numbers.push(i);
    } else if (i === 3 || i === props.books.last_page - 3) {
      numbers.push(". . .");
    }
  }

  return numbers;
});
</script>

<template>
  <Head title="Books" />

  <Layout>
    <div class="flex flex-col items-center mt-6">
      <input
        id="search"
        v-model="search"
        @input="updateSearch($event.target.value)"
        class="border-bronze rounded-md"
        placeholder="Search Books..."
        type="text"
      />
    </div>

    <main class="flex justify-center mt-4">
      <div class="flex flex-col">
        <div class="md:-mx-6 lg:-mx-8 my-2 overflow-x-auto">
          <div
            class="md:px-6 lg:px-8 inline-block min-w-full py-2 align-middle"
          >
            <div
              v-show="props.books.data.length > 0"
              class="shadow-paper md:rounded-lg overflow-hidden"
            >
              <h2 class="bg-bronze text-neutral-50 text-xl">Your Books</h2>

              <div
                v-if="filteredBooks.length === 0 && searchActive"
                class="w-[600px]"
              >
                <h2 class="p-2 text-xl bg-white">No books found.</h2>
              </div>

              <table v-else>
                <thead class="bg-sandy text-lg underline divide-x">
                  <th>Title</th>
                  <th>Author</th>
                  <th>Genre</th>
                  <th class="px-3">Read Status</th>
                  <th class="px-3">Pages</th>
                  <th>Modify</th>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                  <tr
                    v-for="book in filteredBooks"
                    :key="filteredBooks.id"
                    class="divide-x"
                  >
                    <td class="py-m px-3">
                      <div class="text-md">
                        {{ book.title }}
                      </div>
                    </td>

                    <td class="text-md px-3">
                      {{ book.author }}
                    </td>
                    <td class="px-4">
                      {{ book.genre }}
                    </td>
                    <td>
                      <span v-if="book.read">✔️</span>
                    </td>
                    <td>
                      {{ book.pages }}
                    </td>
                    <td class="px-2">
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
                  class="mx-2 hover:text-brown"
                  v-for="(number, index) in pageNumbers"
                  :key="index"
                >
                  <button
                    v-if="number !== '. . .'"
                    :disabled="number === props.books.current_page"
                    @click="goToPage(`/books?page=${number}`)"
                  >
                    {{ number }}
                  </button>

                  <span v-else>
                    {{ number }}
                  </span>
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
              v-show="books.length <= 0"
              class="bg-sandy shadow-paper p-8 rounded-md"
            >
              <h2 class="mb-4 text-2xl">You don't have any books yet.</h2>

              <Link
                class="hover:underline text-brown mt-4 text-xl"
                href="/books/add"
              >
                Add a book!
              </Link>
            </div>
          </div>
        </div>
      </div>
    </main>
  </Layout>
</template>

<style scoped>
#search {
  position: relative;
  padding-left: 36px;
  background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="gray" class="w-2 h-2"%3E%3Cpath fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /%3E%3C/svg%3E');
  background-repeat: no-repeat;
  background-position: left 10px center;
  background-size: 20px 20px;
}
</style>
