<script setup></script>

<template>
  <Head title="Stats" />

  <Layout>
    <main class="flex justify-center">
      <div
        class="flex flex-col justify-center overflow-hidden rounded-md md:w-full lg:w-1/3 sm:w-full"
      >
        <h2 class="text-2xl font-bold text-center bg-bronze text-neutral-50">
          Stats
        </h2>
        <table class="divide-y">
          <tr class="divide-x">
            <th class="w-1/2 pl-2 text-left bg-light-brown">Total Books:</th>
            <td class="pr-2 text-right bg-sandy">37</td>
          </tr>
          <tr class="divide-x">
            <th class="pl-2 text-left bg-light-brown">Books Read This Year:</th>
            <td class="pr-2 text-right bg-sandy">4</td>
          </tr>
          <tr class="divide-x">
            <th class="pl-2 text-left bg-light-brown">Most Read Genre:</th>
            <td class="pr-2 text-right bg-sandy">Horror</td>
          </tr>
        </table>
      </div>
    </main>
  </Layout>
</template>
