<script setup>
import StyledButton from "@/Components/StyledButton.vue";
</script>

<template>
  <div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div
      class="drawer-content m-1 flex flex-col rounded-md bg-tan shadow-paper"
    >
      <!-- Navbar -->
      <div class="navbar w-full rounded-md">
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
              class="inline-block h-6 w-6 stroke-current text-neutral-800"
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
          class="mx-2 flex-1 px-2 text-lg font-bold text-neutral-800 lg:text-xl"
        >
          <Link href="/">Quillify</Link>
        </div>
        <div class="hidden flex-none lg:block">
          <ul class="menu menu-horizontal text-base">
            <!-- Navbar menu content here -->
            <StyledButton v-show="!$page.props.auth.user">
              <Link href="/register">Register</Link>
            </StyledButton>

            <StyledButton v-show="!$page.props.auth.user">
              <Link href="/login">Log In</Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link href="/books/add">Add Book</Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link href="/books">View Books</Link>
            </StyledButton>

            <StyledButton v-show="$page.props.auth.user">
              <Link as="button" href="/logout" method="post" type="button">
                Log Out
              </Link>
            </StyledButton>
          </ul>
        </div>
      </div>
    </div>

    <div class="drawer-side z-10">
      <label
        for="my-drawer-3"
        aria-label="close sidebar"
        class="drawer-overlay"
      ></label>
      <ul class="menu min-h-full w-60 bg-neutral-800/95 text-lg">
        <!-- Sidebar content here -->
        <div
          class="flex flex-col space-y-6 px-4 py-8"
          v-show="!$page.props.auth.user"
        >
          <StyledButton>
            <Link href="/register">Register</Link>
          </StyledButton>

          <StyledButton>
            <Link href="/login">Log In</Link>
          </StyledButton>
        </div>

        <div
          class="flex flex-col space-y-6 px-4 py-8"
          v-show="$page.props.auth.user"
        >
          <StyledButton>
            <Link as="button" href="/logout" method="post" type="button">
              Log Out
            </Link>
          </StyledButton>

          <StyledButton>
            <Link href="/books/add">Add Book</Link>
          </StyledButton>

          <StyledButton>
            <Link href="/books">View Books</Link>
          </StyledButton>
        </div>
      </ul>
    </div>
  </div>
</template>
