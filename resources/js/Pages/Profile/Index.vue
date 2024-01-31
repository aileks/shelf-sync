<script setup>
import { ref } from "vue";

const user = defineProps(["name"]);
const userName = ref(user.name);
</script>

<template>
  <Head title="Profile" />

  <Layout>
    <header>
      <h1 class="ml-4 text-2xl text-left">Hello, {{ userName }}!</h1>

      <aside class="mt-8 ml-4">
        <ul class="text-lg text-left">
          <li>Edit Profile</li>
          <li>Log Out</li>
        </ul>
      </aside>
    </header>

    <main class="flex flex-col items-center justify-center">
      <div class="stat-table">
        <table class="text-left">
          <caption class="text-lg font-bold">
            Stats
          </caption>
          <tr>
            <th>Books Added</th>
            <th>Books Read</th>
          </tr>
          <tr>
            <td>17</td>
            <td>17</td>
          </tr>
        </table>
      </div>
    </main>
  </Layout>
</template>
