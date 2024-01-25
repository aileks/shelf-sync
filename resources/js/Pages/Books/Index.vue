<script setup>
import StyledButton from "@/Shared/StyledButton.vue";

defineProps({
  books: Object,
});
</script>

<template>
  <Head title="Your Books" />
  <Layout>
    <StyledButton>
      <Link href="/"> Home </Link>
    </StyledButton>

    <StyledButton>
      <Link href="/books/add"> Add Another Book </Link>
    </StyledButton>

    <div class="flex justify-center mt-2">
      <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
          >
            <div
              class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg"
            >
              <template v-if="books">
                <h1 class="bg-[#9d8461] text-neutral-50 text-xl">Your Books</h1>
                <table>
                  <thead class="bg-[#cfbda6] divide-x">
                    <th>Title</th>
                    <th>Author</th>
                    <th class="px-4">Read/Unread</th>
                    <th>Pages</th>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                      v-for="(book, index) in books"
                      :key="book.id"
                      class="divide-x"
                    >
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">
                          {{ book.title }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">
                          {{ book.author }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">
                          <span v-if="book.read"><b>Read</b></span>
                          <span v-else><b>Unread</b></span>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium">
                          {{ book.pages }}
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </template>

              <template v-else>
                <div class="flex justify-center">
                  <p class="text-xl">You have no books yet.</p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped></style>
