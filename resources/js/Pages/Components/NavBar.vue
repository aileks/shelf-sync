<script setup>
import StyledButton from "@/Components/StyledButton.vue";
</script>

<template>
  <div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div
      class="flex flex-col m-1 rounded-md drawer-content bg-tan shadow-paper"
    >
      <!-- Navbar -->
      <div class="w-full rounded-md navbar">
        <div class="flex-none lg:hidden">
          <label
            for="my-drawer-3"
            aria-label="open sidebar"
            class="btn btn-square btn-ghost"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              class="inline-block w-6 h-6 stroke-current text-neutral-800"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
            </svg>
          </label>
        </div>
        <div
          class="flex-1 px-2 mx-2 text-lg font-bold text-neutral-800 lg:text-xl"
        >
          Quillify
        </div>
        <div class="flex-none hidden lg:block">
          <ul class="text-base menu menu-horizontal">
            <!-- Navbar menu content here -->
            <StyledButton v-show="!$page.props.auth.user">
              <Link href="/register">Register</Link>
            </StyledButton>

            <StyledButton v-show="!$page.props.auth.user">
              <Link href="/login">Log In</Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link as="button" href="/logout" method="post" type="button">
                Log Out
              </Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link href="/books/add">Add Book</Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link href="/books">View Books</Link>
            </StyledButton>
          </ul>
        </div>
      </div>
    </div>

    <div class="z-10 drawer-side">
      <label
        for="my-drawer-3"
        aria-label="close sidebar"
        class="drawer-overlay"
      ></label>
      <ul class="min-h-full px-4 py-6 space-y-4 text-lg menu w-60">
        <!-- Sidebar content here -->
        <StyledButton v-show="!$page.props.auth.user">
          <Link href="/register">Register</Link>
        </StyledButton>

        <StyledButton v-show="!$page.props.auth.user">
          <Link href="/login">Log In</Link>
        </StyledButton>

        <StyledButton v-show="$page.props.auth.user">
          <Link as="button" href="/logout" method="post" type="button">
            Log Out
          </Link>
        </StyledButton>

        <StyledButton v-show="$page.props.auth.user">
          <Link href="/books/add">Add Book</Link>
        </StyledButton>

        <StyledButton v-show="$page.props.auth.user">
          <Link href="/books">View Books</Link>
        </StyledButton>
      </ul>
    </div>
  </div>
</template>
