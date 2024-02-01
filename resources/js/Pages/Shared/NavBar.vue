<script setup></script>

<template>
  <nav
    class="fixed top-0 left-0 h-full space-y-8 border-r-2 w-[120px] border-bronze bg-primary"
  >
    <div class="flex flex-col items-center justify-between h-full">
      <div class="flex flex-col flex-1 h-full">
        <span class="text-center">LOGO</span>
        <ul class="flex-1 px-1 mx-1 mt-4 font-medium text-center">
          <li v-show="!$page.props.auth.user" class="my-3">
            <Link
              class="font-bold transition-all duration-200 hover:bg-brown hover:text-neutral-50 hover:rounded-md rounded-sm hover:py-1 hover:px-2.5 hover:shadow-paper text-brown"
              href="/register"
              >Register</Link
            >
          </li>

          <li v-show="!$page.props.auth.user" class="my-3">
            <Link
              class="font-bold transition-all duration-200 hover:bg-brown hover:text-neutral-50 hover:rounded-md rounded-sm hover:py-1 hover:px-2.5 hover:shadow-paper text-brown"
              href="/login"
              >Log In</Link
            >
          </li>

          <li v-show="$page.props.auth.user" class="my-3">
            <Link
              class="font-bold transition-all duration-200 hover:bg-brown hover:text-neutral-50 hover:rounded-md rounded-sm hover:py-1 hover:px-2.5 hover:shadow-paper text-brown"
              href="/books"
              >Book List</Link
            >
          </li>

          <li v-show="$page.props.auth.user" class="my-3">
            <Link
              method="POST"
              class="font-bold transition-all duration-200 hover:bg-brown hover:text-neutral-50 hover:rounded-md rounded-sm hover:py-1 hover:px-2.5 hover:shadow-paper text-brown"
              href="/logout"
              >Log Out</Link
            >
          </li>
        </ul>
      </div>
      <div>
        <Link href="/profile">
          <img
            src="https://randomuser.me/api/portraits/women/79.jpg"
            class="w-12 h-12 rounded-full"
          />
        </Link>
      </div>
    </div>
  </nav>
</template>
