<script setup>
  import { computed, ref, watch } from 'vue';
  import { Bar, Line } from 'vue-chartjs';
  import { ChevronDownIcon, CheckIcon } from '@heroicons/vue/20/solid';

  import {
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
    Listbox,
    ListboxOption,
    ListboxOptions,
    ListboxButton,
  } from '@headlessui/vue';

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
  } from 'chart.js';

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

  const props = defineProps({
    user: Object,
    errors: Object,
    activeTab: Number,
    success: String,
    books: Array,
  });

  const availableYears = computed(() => {
    const years = new Set(
      props.books
        .filter(book => book.date_read)
        .map(book => new Date(book.date_read).getFullYear()),
    );

    return [...years].sort((a, b) => b - a); // sort in ascending order
  });

  const availableMonths = computed(() => {
    const months = new Set();

    props.books.forEach(book => {
      if (book.created_at) {
        const month = new Date(book.created_at).getMonth();
        months.add(month);
      }
    });

    return [...months].sort();
  });

  const bookGenres = props.books.map(book => book.genre);

  const selectedYear = ref(new Date().getFullYear());

  // Chart for spread of genres
  const genreCounts = computed(() => {
    const counts = {};
    bookGenres.forEach(genre => {
      counts[genre] = counts[genre] ? counts[genre] + 1 : 1;
    });
    return counts;
  });
  const genreData = {
    labels: Object.keys(genreCounts.value),
    datasets: [
      {
        label: 'Books per Genre',
        data: Object.values(genreCounts.value),
        backgroundColor: '#2e4269b3',
        borderColor: '#2e4269',
        borderWidth: 1,
      },
    ],
  };

  // Chart for books finished per month
  const booksFinishedPerMonth = computed(() => {
    const counts = {};
    props.books.forEach(book => {
      if (book.date_read) {
        const date = new Date(book.date_read);
        const year = date.getFullYear();
        const month = date.getMonth();

        if (!counts[year]) {
          counts[year] = Array(12).fill(0); // Initialize months array for the year
        }

        counts[year][month] += 1;
      }
    });

    return counts;
  });

  const booksFinishedPerMonthData = computed(() => {
    const months = [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec',
    ];

    const dataForSelectedYear =
      booksFinishedPerMonth.value[selectedYear.value] || Array(12).fill(0);

    return {
      labels: months,
      datasets: [
        {
          label: 'Books Finished',
          data: dataForSelectedYear,
          borderColor: '#2e4269',
          // tension: 1,
        },
      ],
    };
  });

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
      </TabList>

      <TabPanels class="mt-6 text-left text-neutral-800">
        <TabPanel class="w-full">
          <Bar :data="genreData" :options="barGraphOptions" />
        </TabPanel>

        <TabPanel class="flex w-full flex-col">
          <Listbox v-model="selectedYear">
            <ListboxButton
              class="relative mb-1 flex w-1/6 cursor-default items-center self-end rounded-md bg-white py-1 pl-2 shadow-paper focus:outline-none"
            >
              <ChevronDownIcon aria-hidden="true" class="mx-1 h-6 w-6 pr-2" />

              {{ selectedYear }}
            </ListboxButton>

            <Transition
              enter-active-class="transition duration-150 ease-out"
              enter-from-class="opacity-0"
              leave-active-class="transition duration-100 ease-in"
              leave-to-class="opacity-0"
            >
              <ListboxOptions
                class="absolute mt-[2.25rem] max-h-60 w-24 items-center justify-center self-end overflow-auto rounded-md bg-white shadow-paper ring-1 ring-black/5 focus:outline-none"
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
                      active ?
                        'bg-dark-tan text-neutral-50'
                      : 'text-neutral-800',
                      'relative cursor-default select-none py-1 text-center',
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

                    <!-- <span -->
                    <!--   v-if="selected" -->
                    <!--   class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue" -->
                    <!-- > -->
                    <!--   <CheckIcon -->
                    <!--     :class="{ 'text-neutral-50': active }" -->
                    <!--     aria-hidden="true" -->
                    <!--     class="h-6 w-6 pr-2" -->
                    <!--   /> -->
                    <!-- </span> -->
                  </li>
                </ListboxOption>
              </ListboxOptions>
            </Transition>
          </Listbox>

          <div class="mt-4">
            <Line
              :data="booksFinishedPerMonthData"
              :options="lineGraphOptions"
            />
          </div>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </TabPanel>
</template>
