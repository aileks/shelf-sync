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
        <div class="my-2 overflow-x-auto md:-mx-6 lg:-mx-8">
          <div
            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
          >
            <div
              class="overflow-hidden border-b border-gray-200 shadow md:rounded-lg"
            >
              <template v-if="books">
                <h1 class="bg-[#9d8461] text-neutral-50 text-xl">Your Books</h1>
                <table>
                  <thead class="bg-[#cfbda6] text-lg underline divide-x">
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th class="px-3">Read?</th>
                    <th>Pages</th>
                    <th>Modify</th>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                      v-for="(book, index) in books"
                      :key="book.id"
                      class="divide-x"
                    >
                      <td class="px-3">
                        <div class="text-md">
                          {{ book.title }}
                        </div>
                      </td>
                      <td class="px-3">
                        <div class="text-md">
                          {{ book.author }}
                        </div>
                      </td>
                      <td class="px-4">
                        <div class="text-md">
                          {{ book.genre }}
                        </div>
                      </td>
                      <td>
                        <span class="text-center" v-if="book.read">✔️</span>
                      </td>
                      <td>
                        <div class="text-md">
                          {{ book.pages }}
                        </div>
                      </td>
                      <td class="px-2">
                        <Link
                          :href="`/books/edit/${book.id}`"
                          class="inline-block text-[#2e4269] hover:underline"
                        >
                          Edit
                        </Link>
                        <p class="inline-block mx-1 px-0.5">|</p>
                        <Link
                          href="#"
                          class="inline-block text-[#9e442e] hover:underline"
                        >
                          Delete
                        </Link>
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
