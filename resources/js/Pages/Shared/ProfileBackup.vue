<template>
  <div class="items-center mt-2 overflow-hidden lg:grid lg:grid-cols-3">
    <header
      id="sidebar"
      class="lg:col-start-1 flex flex-col px-6 py-4 mx-4 rounded-md text-neutral-50 shadow-paper bg-brown w-full lg:w-[250px]"
    >
      <h1 class="mt-2 text-2xl">Hello,</h1>
      <h1 class="mb-3 text-2xl">{{ userName }}!</h1>
      <ul class="text-lg">
        <li><Link href="#">Stats</Link></li>
        <li><Link href="#">Settings</Link></li>
      </ul>
    </header>
  </div>

  <main
    class="lg:col-start-2 lg:col-span-1 flex flex-col w-full lg:w-[500px] overflow-hidden shadow-paper md:rounded-lg mx-4"
  >
    <h2 class="text-xl text-center bg-bronze text-neutral-50">Stats</h2>
    <table>
      <tr class="divide-x">
        <th class="w-1/2 pl-2 text-left bg-light-brown">Total Books:</th>
        <td class="pr-2 text-right bg-sandy">37</td>
      </tr>
      <tr class="divide-x">
        <th class="pl-2 text-left bg-light-brown">Books Read This Year</th>
        <td class="pr-2 text-right bg-sandy">4</td>
      </tr>
      <tr class="divide-x">
        <th class="pl-2 text-left bg-light-brown">Most Read Genre</th>
        <td class="pr-2 text-right bg-sandy">Horror</td>
      </tr>
    </table>
  </main>
</template>
