<script setup>
import { onMounted, watch, ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import StyledButton from "@/Components/StyledButton.vue";
import {
  TabGroup,
  TabList,
  Tab,
  TabPanels,
  TabPanel,
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionRoot,
  TransitionChild,
} from "@headlessui/vue";

const props = defineProps({
  user: Object,
  books: Number,
  errors: Object,
  activeTab: Number,
  success: String,
});

const activeTab = ref(props.activeTab);
const success = ref(props.success);

let isOpen = ref(false);
const openModal = () => {
  isOpen.value = true;
};
const closeModal = () => {
  isOpen.value = false;
};

const deleteAccount = () => {
  router.delete("/profile");
};

// Update Profile
const form = useForm({
  email: null,
  confirmEmail: null,
  currentPassword: null,
});

// Realtime validation
let validateEmail = (email, confirmEmail) => {
  props.errors.email = null; // reset email errors

  const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/;

  if (!emailRegex.test(email)) {
    props.errors.email = "Invalid email";
    return;
  }

  if (email !== confirmEmail) {
    props.errors.email = "Emails do not match";
  }
};
watch(
  () => form.email,
  (newEmail) => {
    validateEmail(newEmail, form.confirmEmail);
  },
);
watch(
  () => form.confirmEmail,
  (newConfirmEmail) => {
    validateEmail(form.email, newConfirmEmail);
  },
);

onMounted(() => {
  if (success) {
    setTimeout(() => {
      success.value = null;
    }, 3000);
  }
});

const submit = () => {
  if (props.errors.email !== null) {
    return;
  }
  form.post("/profile");
};
</script>

<template>
  <Head title="Profile" />
  {{ console.log(activeTab) }}
  <Layout>
    <div class="grid place-items-center">
      <TabGroup
        :default-index="0"
        as="TabGroup"
        class="w-full max-w-screen-sm rounded-md bg-sandy p-4 shadow-paper"
      >
        <h3 class="mb-4 text-left text-xl font-bold">Hello, {{ user.name }}</h3>

        <TabList
          class="flex items-center justify-start space-x-8 font-semibold"
        >
          <Tab as="template" v-slot="{ selected }">
            <button
              class="px-2 py-1 outline-none md:text-lg"
              :class="{
                'border-b-2 border-accent': selected,
              }"
            >
              Settings
            </button>
          </Tab>
        </TabList>

        <TabPanels class="p-4 text-neutral-800">
          <TabPanel class="w-full">
            <TabGroup as="div" class="flex gap-8">
              <TabList class="flex flex-col space-y-4">
                <Tab class="text-left" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 text-sm outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Your Account
                  </button>
                </Tab>

                <!-- FIXME: Redirect should return to this tab -->
                <Tab class="text-left" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 text-sm outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Update Email
                  </button>
                </Tab>

                <Tab class="text-left" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 text-sm outline-none transition-colors duration-200"
                    :class="{
                      'text-red': !selected,
                      'bg-red text-neutral-50': selected,
                    }"
                  >
                    Delete Account
                  </button>
                </Tab>
              </TabList>

              <TabPanels class="flex flex-grow justify-center">
                <TabPanel
                  :selected="activeTab === 0"
                  class="flex w-full flex-col items-center space-y-8 rounded-md"
                >
                  <div class="flex w-2/3 justify-between border-b border-blue">
                    <span class="font-semibold">Name:</span>
                    <span class="italic">{{ user.name }}</span>
                  </div>

                  <div class="flex w-2/3 justify-between border-b border-blue">
                    <span class="font-semibold">Email:</span>
                    <span class="italic">{{ user.email }}</span>
                  </div>

                  <div class="flex w-2/3 justify-between border-b border-blue">
                    <span class="font-semibold"> Total Books:</span>
                    <span class="italic">{{ books }}</span>
                  </div>
                </TabPanel>

                <!-- FIXME: Redirect should return to this tab -->
                <TabPanel :selected="activeTab === 0" class="w-full">
                  <form @submit.prevent="submit">
                    <div
                      class="flex flex-col justify-center space-y-4 text-left"
                    >
                      <label for="email" class="text-left font-medium">
                        New Email:
                      </label>
                      <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        placeholder="Email"
                        class="mt-2 block rounded-md px-2 py-1 outline-none"
                      />

                      <label for="email" class="text-left font-medium">
                        Confirm New Email:
                      </label>
                      <input
                        id="confirm-email"
                        v-model="form.confirmEmail"
                        type="email"
                        placeholder="Confirm Email"
                        class="mt-2 block rounded-md px-2 py-1 outline-none"
                      />
                      <div v-if="errors.email" class="error">
                        {{ errors.email }}
                      </div>

                      <label
                        for="currentPassword"
                        class="text-left font-medium"
                      >
                        Current Password:
                      </label>
                      <input
                        id="currentPassword"
                        v-model="form.currentPassword"
                        type="password"
                        placeholder="Current Password"
                        class="mt-2 block rounded-md px-2 py-1 outline-none"
                      />

                      <div v-if="errors.currentPassword" class="error">
                        {{ errors.currentPassword }}
                      </div>
                    </div>

                    <div class="flex items-end justify-end pt-8">
                      <StyledButton type="submit" :disabled="props.errors.email"
                        >Save</StyledButton
                      >
                    </div>
                  </form>
                </TabPanel>

                <TabPanel class="w-full">
                  <h2 class="text-xl font-semibold">
                    Do you want to delete your account?
                  </h2>

                  <button
                    @click="openModal"
                    class="mt-4 transform rounded-md border border-red px-4 py-2 text-xl font-bold text-red transition-all duration-150 hover:bg-red hover:text-neutral-50"
                  >
                    Delete
                  </button>
                </TabPanel>
              </TabPanels>
            </TabGroup>
          </TabPanel>
        </TabPanels>
      </TabGroup>
    </div>

    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div
            class="flex min-h-full items-center justify-center p-4 text-center"
          >
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                  as="h2"
                  class="text-xl font-semibold italic leading-6 text-neutral-800 underline"
                >
                  THIS ACTION CANNOT BE UNDONE!
                </DialogTitle>

                <div class="mt-2 flex flex-col">
                  <span class="text-neutral-700">
                    Are you sure you want to delete your account?
                  </span>
                </div>

                <div class="mt-4 flex justify-between">
                  <button
                    type="submit"
                    class="inline-flex transform justify-center rounded-md border border-transparent bg-red px-4 py-2 text-sm font-medium text-neutral-50 transition-all duration-150 hover:bg-red/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue focus-visible:ring-offset-2"
                    @click="deleteAccount"
                  >
                    Yes, Delete My Account
                  </button>

                  <button
                    type="button"
                    class="inline-flex transform justify-center rounded-md border border-transparent bg-green px-4 py-2 text-sm font-medium text-neutral-50 transition-all duration-150 hover:bg-green/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue focus-visible:ring-offset-2"
                    @click="closeModal"
                  >
                    No, Keep My Account
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </Layout>

  <Teleport to="body">
    <div
      v-show="success"
      class="fixed top-14 z-50 m-6 max-w-xs overflow-hidden rounded-lg bg-green shadow-lg"
      @click="success = null"
    >
      <div class="px-4 py-2 text-neutral-50">
        {{ success }}
      </div>
    </div>
  </Teleport>
  {{ console.log(success) }}
</template>
