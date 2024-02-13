<script setup>
import { computed, ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { Bar, Line } from "vue-chartjs";
import { ChevronDownIcon, CheckIcon } from "@heroicons/vue/20/solid";
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
  Listbox,
  ListboxButton,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
);

let isOpen = ref(false);
const openModal = () => {
  isOpen.value = true;
};
const closeModal = () => {
  isOpen.value = false;
};

const props = defineProps({
  user: Object,
  books: Object,
  errors: Object,
});

// TODO: Implement
// const form = useForm({
//   email: null,
//   confirmEmail: null,
//   currentPassword: null,
// });

const totalBooks = Object.values(props.books).length;
const bookGenres = Object.values(props.books).map((book) => book.genre);
const availableYears = computed(() => {
  const years = new Set();
  props.books.forEach((book) => {
    if (book.created_at) {
      const year = new Date(book.created_at).getFullYear();
      years.add(year);
    }
  });
  return [...years].sort();
});
let selectedYear = ref(availableYears.value[0]);

// Chart for spread of genres
const genreCounts = computed(() => {
  const counts = {};
  bookGenres.forEach((genre) => {
    counts[genre] = counts[genre] ? counts[genre] + 1 : 1;
  });
  return counts;
});
const genreData = {
  labels: Object.keys(genreCounts.value),
  datasets: [
    {
      label: "Books per Genre",
      data: Object.values(genreCounts.value),
      backgroundColor: "#2e4269b3",
      borderColor: "#2e4269",
      borderWidth: 1,
    },
  ],
};

// Chart for books finished per year
const booksFinishedPerYear = computed(() => {
  return Object.values(props.books).reduce((counts, book) => {
    if (book.date_read) {
      const year = new Date(book.date_read).getFullYear();
      counts[year] = counts[year] ? counts[year] + 1 : 1;
    }
    return counts;
  }, {});
});
const booksFinishedPerYearData = {
  labels: Object.keys(booksFinishedPerYear.value),
  datasets: [
    {
      label: "Books Finished",
      data: Object.values(booksFinishedPerYear.value),
      borderColor: "#2e4269",
      tension: 0.4,
    },
  ],
};
// Chart for books added per day in a given year
const booksAddedPerDay = computed(() => {
  const currentYear = new Date().getFullYear();
  return Object.values(props.books).reduce((counts, book) => {
    if (book.created_at) {
      const date = new Date(book.created_at);
      const year = date.getFullYear();
      if (year === currentYear) {
        const day = date.toISOString().split("T")[0];
        counts[day] = counts[day] ? counts[day] + 1 : 1;
      }
    }
    return counts;
  }, {});
});
const booksAddedPerDayData = {
  labels: Object.keys(booksAddedPerDay.value),
  datasets: [
    {
      label: "Books Added",
      data: Object.values(booksAddedPerDay.value),
      borderColor: "#2e4269",
      tension: 0.4,
    },
  ],
};

const barGraphOptions = {
  responsive: true,
  plugins: {
    legend: {
      display: false,
    },
  },
  scales: {
    y: {
      beginAtZero: true,
    },
  },
};
const lineGraphOptions = {
  responsive: true,
  plugins: {
    legend: {
      display: false,
    },
  },
  scales: {
    y: {
      beginAtZero: true,
      ticks: {
        stepSize: 1,
        callback: function (value) {
          if (Math.floor(value) === value) {
            return value;
          }
        },
      },
    },
  },
};

const deleteAccount = () => {
  router.delete("/profile");
};

// TODO: Implement
// const submit = () => {
//   form.post("/profile/update");
// };
</script>

<template>
  <Head title="Profile" />

  <Layout>
    <!-- TODO: Implement/Complete -->
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
              class="px-2 py-1 outline-none"
              :class="{
                'border-b-2 border-accent': selected,
              }"
            >
              Settings
            </button>
          </Tab>

          <Tab as="template" v-slot="{ selected }">
            <button
              class="px-2 py-1 outline-none"
              :class="{
                'border-b-2 border-accent': selected,
              }"
            >
              Graphs
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
                <!-- <Tab class="text-left" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 text-sm outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Update Email
                  </button>
                </Tab> -->

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
                    <span class="italic">{{ totalBooks }}</span>
                  </div>
                </TabPanel>

                <!-- FIXME: Redirect should return to this tab -->
                <!-- <TabPanel class="w-full">
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
                        id="email"
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
                      <StyledButton type="submit">Save</StyledButton>
                    </div>
                  </form>
                </TabPanel> -->

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

          <TabPanel class="w-full">
            <TabGroup>
              <TabList
                class="flex items-center justify-start space-x-2 text-sm font-medium"
              >
                <Tab as="template" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Books Per Genre
                  </button>
                </Tab>

                <Tab as="template" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Books Finished Per Year
                  </button>
                </Tab>

                <Tab as="template" v-slot="{ selected }">
                  <button
                    class="transform rounded-md px-2 py-1 outline-none transition-colors duration-200"
                    :class="{
                      'text-nuetral-800': !selected,
                      'bg-accent text-neutral-50': selected,
                    }"
                  >
                    Books Added Per Day
                  </button>
                </Tab>
              </TabList>

              <TabPanels class="mt-6 text-left text-neutral-800">
                <TabPanel class="w-full">
                  <Bar :data="genreData" :options="barGraphOptions" />
                </TabPanel>

                <TabPanel class="w-full">
                  <Line
                    :data="booksFinishedPerYearData"
                    :options="lineGraphOptions"
                  />
                </TabPanel>

                <TabPanel class="flex w-full flex-col">
                  <Listbox v-model="selectedYear">
                    <ListboxButton
                      class="relative flex w-1/6 cursor-default items-center self-end rounded-md bg-white px-2 py-1 text-left shadow-paper focus:outline-none"
                    >
                      <ChevronDownIcon
                        aria-hidden="true"
                        class="h-6 w-6 pr-2"
                      />

                      {{ selectedYear }}
                    </ListboxButton>

                    <Transition
                      enter-active-class="transition duration-150 ease-out"
                      enter-from-class="opacity-0"
                      leave-active-class="transition duration-100 ease-in"
                      leave-to-class="opacity-0"
                    >
                      <ListboxOptions
                        class="absolute mt-9 flex max-h-60 max-w-md items-center justify-center self-end overflow-auto rounded-md bg-white py-1 shadow-paper ring-1 ring-black/5 focus:outline-none"
                      >
                        <ListboxOption
                          :key="year.id"
                          :value="year"
                          v-for="year in availableYears"
                          as="template"
                          v-slot="{ active, selected }"
                        >
                          <li
                            :class="[
                              active
                                ? 'bg-brown text-neutral-50'
                                : 'text-neutral-800',
                              'relative cursor-default select-none py-1 pl-10 pr-4',
                            ]"
                          >
                            <span
                              :class="[
                                selected ? 'font-medium' : 'font-normal',
                                'block truncate',
                              ]"
                            >
                              {{ year }}
                            </span>

                            <span
                              v-if="selected"
                              class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue"
                            >
                              <CheckIcon
                                :class="{ 'text-neutral-50': active }"
                                aria-hidden="true"
                                class="h-3 w-3"
                              />
                            </span>
                          </li>
                        </ListboxOption>
                      </ListboxOptions>
                    </Transition>
                  </Listbox>

                  <Line
                    :data="booksAddedPerDayData"
                    :options="lineGraphOptions"
                  />
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
</template>
