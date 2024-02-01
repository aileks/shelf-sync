<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import StyledButton from "@/Shared/StyledButton.vue";

const isSubMenuOpen = ref(false);

const handleEscapePress = (e) => {
  if (e.key === "Escape") {
    isSubMenuOpen.value = false;
  }
};

onMounted(() => {
  window.addEventListener("keydown", handleEscapePress);
});
</script>

<template>
  <nav
    class="flex px-1 py-2 mx-2 mt-2 space-x-4 rounded-md bg-sandy shadow-paper"
  >
    <div class="mr-auto">
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
    </div>

    <div class="ml-auto">
      <StyledButton v-show="$page.props.auth.user">
        <Link href="/books/add">Add Book</Link>
      </StyledButton>

      <StyledButton v-show="$page.props.auth.user">
        <Link href="/books">View Books</Link>
      </StyledButton>

      <!-- <StyledButton
        v-show="$page.props.auth.user"
        @click="isSubMenuOpen = !isSubMenuOpen"
      >
        Profile
      </StyledButton>

      <Transition
        enter-active-class="transition duration-100 ease-in"
        leave-active-class="transition duration-100 ease-out"
        enter-from-class="scale-95"
        leave-to-class="scale-95"
      >
        <div
          v-show="isSubMenuOpen"
          class="absolute right-0 w-48 mt-2 mr-2 rounded-md shadow-paper bg-sandy submenu"
        >
          <div
            class="py-1"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="options-menu"
          >
            <Link
              href="/profile/stats"
              class="block px-4 py-2 text-sm transition-all duration-300 hover:bg-brown/90 hover:text-neutral-50"
              role="menuitem"
              >Stats</Link
            >
            <Link
              href="/profile/settings"
              class="block px-4 py-2 text-sm transition-all duration-300 hover:bg-brown/90 hover:text-neutral-50"
              role="menuitem"
              >Settings</Link
            >
          </div>
        </div>
      </Transition> -->
    </div>
  </nav>
</template>
