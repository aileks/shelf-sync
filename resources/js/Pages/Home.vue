<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import {onMounted, ref} from 'vue'

const animate = ref(false)

onMounted(() => {
  animate.value = true
})
</script>

<template>
  <Head title="Your Personal Library"/>

  <Layout>
    <p class="text-2xl">Welcome to Quillify!</p>
    <p class="text-xl mt-2">Keep track of all those books you don't read. ;)</p>

    <div class="flex justify-center space-x-4 mt-10">
      <StyledButton>
        <Link href="/register">
          Register
        </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/login">
          Login
        </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/books/add">
          Add Book
        </Link>
      </StyledButton>

      <StyledButton>
        <Link href="/books">
          View Books
        </Link>
      </StyledButton>
    </div>
  </Layout>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
