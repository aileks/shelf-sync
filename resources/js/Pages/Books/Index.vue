<script setup>
  import MobileModal from '@/Components/MobileModal.vue';
  import { onMounted, onUnmounted, ref, watch } from 'vue';
  import { router, usePage } from '@inertiajs/vue3';
  import debounce from 'lodash/debounce';
  import { CheckIcon } from '@heroicons/vue/20/solid';

  const queryParams = usePage().url.split('?')[1];

  const props = defineProps({
    books: Object,
    success: String,
  });

  const books = ref(props.books);
  const success = ref(props.success);
  const isMobile = ref(window.innerWidth <= 800);
  let clickCount = 0;

  // Sorting
  const sortBy = ref('');
  const sortDirection = ref('asc');
  const changeSort = column => {
    if (sortBy.value === column) {
      clickCount++;
      if (clickCount === 3) {
        sortBy.value = null;
        sortDirection.value = null;
        clickCount = 0;
      } else {
        sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
      }
    } else {
      sortBy.value = column;
      sortDirection.value = 'asc';
      clickCount = 1;
    }

    if (sortBy.value !== null && sortDirection.value !== null) {
      router.get(
        '/books',
        {
          sort_by: sortBy.value,
          sort_direction: sortDirection.value,
          page: books.value.current_page,
        },
        {
          preserveState: true,
          onSuccess: page => {
            books.value = page.props.books;
          },
        },
      );
    } else {
      router.get(
        '/books',
        {
          page: books.value.current_page,
        },
        {
          preserveState: true,
          onSuccess: page => {
            books.value = page.props.books;
          },
        },
      );
    }
  };
  const sortIcon = column => {
    if (sortBy.value !== column) {
      return '';
    }
    return sortDirection.value === 'asc' ? '▲' : '▼';
  };

  // Mobile reactivity
  const updateIsMobile = () => {
    isMobile.value = window.innerWidth <= 800;
  };

  // Delete book
  const deleteBook = id => {
    router.delete(`/books/${id}`, {
      onBefore: () => {
        if (!confirm('Are you sure you want to delete this book?')) {
          return false;
        }
      },
      onSuccess: () => {
        router.get('/books', {
          page: books.value.current_page,
        });
      },
    });
  };

  // Search functionality
  let search = ref('');
  let isSearchActive = ref(false);
  watch(
    search,
    debounce(value => {
      router.get(
        '/books',
        { search: value },
        {
          preserveState: true,
          onSuccess: page => {
            books.value = page.props.books;
            isSearchActive.value = true;
          },
        },
      );
    }, 300),
  );

  // Hooks
  onMounted(() => {
    window.addEventListener('resize', updateIsMobile);
    if (success) {
      setTimeout(() => {
        success.value = null;
      }, 3000);
    }
  });

  onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile);
  });
</script>

<template>
  <Head title="Books" />

  <Layout>
    <div class="flex items-center justify-around">
      <input
        v-show="books.data"
        id="search"
        v-model="search"
        class="w-72 rounded-md border-accent shadow-paper dark:border-dark-accent sm:w-[80%] md:w-[60%] lg:w-60"
        placeholder="Search Books..."
        type="search"
      />
      <MobileModal :changeSort="changeSort" :isMobile="isMobile" />
    </div>

    <!-- TODO: Extract mobile and desktop views into separate components -->
    <!-- Mobile View -->
    <div
      v-show="isMobile"
      class="mx-1 flex flex-col items-center justify-center"
    >
      <div
        class="mt-4 flex w-full flex-col items-center justify-center overflow-hidden rounded-md shadow-paper"
      >
        <h2 class="w-full bg-brown text-xl text-neutral-50 dark:bg-dark-brown">
          Your Books
        </h2>

        <ul class="w-full space-y-1 divide-y divide-neutral-400 bg-white px-1">
          <li
            v-for="book in books.data"
            :key="book.id"
            class="mx-2 flex items-center py-4"
          >
            <div class="flex w-full flex-grow flex-col space-y-1">
              <div
                class="flex flex-nowrap justify-center space-x-2 text-center font-bold italic"
              >
                {{ book.title }}
              </div>

              <div class="py-1 font-semibold">
                {{ book.author }}
              </div>

              <div
                v-show="book.read && book.date_read"
                class="pb-2 text-sm font-medium"
              >
                Finished on
                <span class="font-bold text-green dark:text-dark-green">
                  {{
                    new Date(book.date_read).toLocaleDateString(undefined, {
                      year: 'numeric',
                      month: 'short',
                      day: 'numeric',
                    })
                  }}
                </span>
              </div>

              <div
                class="mt-2 flex items-center justify-around text-sm font-medium text-brown"
              >
                <span class="mx-2 whitespace-nowrap px-2">
                  {{ book.pages }} pgs
                </span>
                <span class="mx-2 px-2">{{ book.publish_year }}</span>
                <span class="mx-2 whitespace-nowrap px-2">{{
                  book.genre
                }}</span>
              </div>
            </div>

            <div class="flex w-1/2 items-center justify-end font-semibold">
              <Link
                :href="`/books/edit/${book.id}`"
                class="mr-3 text-blue hover:underline dark:text-dark-blue"
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
      </div>

      <!-- Mobile Pagination  -->
      <div
        class="flex w-full items-center justify-around bg-brown py-2 text-center dark:bg-dark-brown"
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
        <h2 class="bg-brown text-2xl text-neutral-50 dark:bg-dark-brown">
          Your Books
        </h2>

        <div
          v-if="isSearchActive && books.data.length === 0"
          class="bg-white p-8 shadow-paper"
        >
          <h2 class="text-xl">No books found.</h2>
        </div>

        <table v-else class="w-full table-auto">
          <thead
            class="divide-x bg-bronze text-lg font-bold text-neutral-50 dark:bg-dark-bronze sm:text-base md:text-lg"
          >
            <th
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
              @click="changeSort('read')"
            >
              <span>{{ sortIcon('read') }}</span>
              Finished
            </th>
            <th
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
              @click="changeSort('title')"
            >
              <span>{{ sortIcon('title') }}</span>
              Title
            </th>
            <th
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
              @click="changeSort('author')"
            >
              <span>{{ sortIcon('author') }}</span>
              Author
            </th>
            <th
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
              @click="changeSort('genre')"
            >
              <span>{{ sortIcon('genre') }}</span>
              Genre
            </th>
            <th
              class="cursor-pointer px-2 sm:w-auto md:w-auto"
              @click="changeSort('pages')"
            >
              <span>{{ sortIcon('pages') }}</span>
              Pages
            </th>
            <th
              class="px-2 sm:w-auto md:w-auto"
              @click="changeSort('publish_year')"
            >
              <span>{{ sortIcon('publish_year') }}</span>
              Published
            </th>
            <th class="px-2 sm:w-auto md:w-auto">Modify</th>
          </thead>

          <tbody class="flex-1 divide-y divide-gray-200 bg-white">
            <tr v-for="book in books.data" :key="book.id" class="divide-x">
              <td class="px-2 sm:w-auto md:w-auto" data-label="Read">
                <div class="flex items-center justify-center">
                  <span v-if="book.read && book.finished && !book.date_read">
                    <CheckIcon
                      class="h-6 w-6 text-green dark:text-dark-green"
                    />
                  </span>

                  <span
                    v-else-if="book.read && book.finished && book.date_read"
                    class="font-bold text-green dark:text-dark-green"
                  >
                    {{
                      new Date(book.date_read).toLocaleDateString(undefined, {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        timeZone: 'UTC',
                      })
                    }}
                  </span>

                  <span
                    v-else-if="book.read && !book.finished && !book.date_read"
                    class="font-bold text-green dark:text-dark-green"
                  >
                    DNF
                  </span>
                </div>
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
                {{ book.publish_year }}
              </td>

              <td class="px-2 sm:space-x-0 md:space-x-1" data-label="Modify">
                <Link
                  :href="`/books/edit/${book.id}`"
                  class="inline-block text-blue hover:underline dark:text-dark-blue"
                >
                  Edit
                </Link>

                <button
                  class="inline-block text-red hover:underline dark:text-dark-red"
                  @click.prevent="deleteBook(book.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Desktop Pagination  -->
        <div class="bg-brown py-2 text-neutral-50 dark:bg-dark-brown">
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
        class="mx-auto max-w-md rounded-md bg-sandy p-8 shadow-paper dark:bg-dark-bronze"
      >
        <h2 class="mb-4 text-2xl">You don't have any books yet.</h2>

        <Link
          class="mt-4 text-xl text-brown hover:underline dark:text-dark-brown"
          href="/books/add"
        >
          Add a book!
        </Link>
      </div>
    </div>
  </Layout>

  <Teleport to="body">
    <div
      v-show="success"
      class="fixed top-14 z-50 m-6 max-w-xs overflow-hidden rounded-lg bg-green shadow-lg dark:bg-dark-green"
      @click="success = null"
    >
      <div class="px-4 py-2 text-neutral-50">
        {{ success }}
      </div>
    </div>
  </Teleport>
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
