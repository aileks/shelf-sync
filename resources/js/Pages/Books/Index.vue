<script setup>
import StyledButton from "@/Shared/StyledButton.vue";

defineProps({
  books: Object,
});
</script>

<template>
  <Head title="Your Books" />
  <Layout>
    <h1 class="text-xl mb-4">Your Books</h1>

    <StyledButton>
      <Link href="/"> Home </Link>
    </StyledButton>

    <StyledButton>
      <Link href="/books/add"> Add Another Book </Link>
    </StyledButton>

    <div class="flex justify-center mt-8">
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
            >
              <template v-if="books">
                <table class="min-w-full divide-y divide-gray-200">
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="book in books" :key="book.id">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div>
                            <div class="text-sm font-medium text-gray-900">
                              <b>Title:</b> {{ book.title }} || <b>Author:</b>
                              {{ book.author }} ||
                              <span v-if="book.read"><b>Read</b></span>
                              <span v-else><b>Unread</b></span> || <b>Pages:</b>
                              {{ book.pages }}
                            </div>
                          </div>
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
