<script setup>
import { Bar, Line } from "vue-chartjs";
import { ChevronDownIcon, CheckIcon } from "@heroicons/vue/20/solid";

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

const selectedYear = ref(null);
watch(
  availableYears,
  (newVal) => {
    if (newVal.length > 0) {
      selectedYear.value = newVal[newVal.length - 1];
    }
  },
  { immediate: true },
);

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
</script>

<template>
  <!-- <Tab as="template" v-slot="{ selected }">
            <button
              class="px-2 py-1 outline-none"
              :class="{
                'border-b-2 border-accent': selected,
              }"
            >
              Graphs
            </button>
          </Tab> -->
  <!-- <TabPanel class="w-full">
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
          </TabPanel> -->
</template>
