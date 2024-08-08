<script setup>
  import StyledButton from '@/Components/StyledButton.vue';
  import DarkModeToggleButton from '@/Components/DarkModeToggleButton.vue';
  import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
</script>

<template>
  <div :class="['drawer', darkMode ? 'dark' : '']">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div
      class="drawer-content m-1 flex flex-col rounded-md bg-tan shadow-paper dark:bg-dark-tan"
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
              class="inline-block h-6 w-6 stroke-current"
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
          <img
            class="h-12 w-12 rounded-md shadow-paper transition-all duration-300 hover:opacity-90 hover:shadow-none"
            src="https://raw.githubusercontent.com/aileks/quillify/main/public/quill-logo.png"
            alt="minimalistic quill logo"
          />
        </div>

        <div class="hidden flex-none lg:block">
          <ul class="menu menu-horizontal text-base">
            <Link href="/login">
              <StyledButton v-show="!$page.props.auth.user">
                Log In
              </StyledButton>
            </Link>

            <Link href="/books/add">
              <StyledButton v-show="$page.props.auth.user">
                Add Book
              </StyledButton>
            </Link>
            <Link href="/books">
              <StyledButton v-show="$page.props.auth.user">
                View Books
              </StyledButton>
            </Link>

            <Menu
              as="div"
              class="relative z-10 inline-block text-left"
              v-show="$page.props.auth.user"
            >
              <MenuButton
                class="mx-1 rounded-md bg-brown px-2.5 py-1 text-neutral-50 shadow-paper transition-all duration-300 hover:bg-brown/80 hover:shadow-none dark:bg-dark-brown"
              >
                Account
              </MenuButton>

              <Transition
                enter-active-class="transition duration-150 ease-out"
                enter-from-class="transform opacity-0 scale-95"
                leave-to-class="transform opacity-0 scale-95"
              >
                <MenuItems
                  class="absolute right-0 mt-2 w-32 origin-top-right rounded-md bg-tan font-medium shadow-paper ring-1 ring-black/5 focus:outline-none"
                >
                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                      <Link
                        :class="[
                          active ?
                            'bg-brown text-neutral-50'
                          : 'text-neutral-800',
                          'group flex w-full items-center rounded-md px-2 py-2 text-base',
                        ]"
                        href="/profile"
                      >
                        Profile
                      </Link>
                    </MenuItem>

                    <MenuItem v-slot="{ active }">
                      <Link
                        :class="[
                          active ?
                            'bg-brown text-neutral-50'
                          : 'text-neutral-800',
                          'group flex w-full items-center rounded-md px-2 py-2 text-base',
                        ]"
                        href="/logout"
                        method="post"
                      >
                        Log Out
                      </Link>
                    </MenuItem>
                  </div>
                </MenuItems>
              </Transition>
            </Menu>
          </ul>
        </div>

        <DarkModeToggleButton />
      </div>
    </div>

    <div class="drawer-side z-10">
      <label
        for="my-drawer-3"
        aria-label="close sidebar"
        class="drawer-overlay"
      ></label>
      <ul
        class="dark:bg-dark-background menu min-h-full w-60 bg-neutral-800 text-lg"
      >
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
            <Link href="/profile">Profile</Link>
          </StyledButton>

          <StyledButton>
            <Link href="/logout" method="post">Log Out</Link>
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
