<script setup></script>

<template>
  <Head title="Stats" />

  <Layout>
    <main class="flex justify-center">
      <div
        class="flex flex-col justify-center overflow-hidden rounded-md sm:w-full md:w-full lg:w-1/3"
      >
        <h2 class="bg-bronze text-center text-2xl font-bold text-neutral-50">
          Stats
        </h2>
        <table class="divide-y">
          <tr class="divide-x">
            <th class="bg-lightbrown w-1/2 pl-2 text-left">Total Books:</th>
            <td class="bg-sandy pr-2 text-right">37</td>
          </tr>
          <tr class="divide-x">
            <th class="bg-lightbrown pl-2 text-left">Books Read This Year:</th>
            <td class="bg-sandy pr-2 text-right">4</td>
          </tr>
          <tr class="divide-x">
            <th class="bg-lightbrown pl-2 text-left">Most Read Genre:</th>
            <td class="bg-sandy pr-2 text-right">Horror</td>
          </tr>
        </table>
      </div>
    </main>
  </Layout>
</template>
