<script setup>
import StyledButton from "@/Shared/StyledButton.vue";
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";
import { useForm } from "@inertiajs/vue3";
import FormButtons from "../Shared/FormButtons.vue";

let form = useForm({
  email: "",
  password: "",
});

let submit = () => {
  form.post("/login");
};
</script>

<template>
  <Head title="Login" />

  <Layout>
    <FormLayout>
      <h2 class="text-xl border-[#9d8461] border-b pb-1.5">Login</h2>
      <form @submit.prevent="submit">
        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="email">Email</label>
          <input
            v-model="form.email"
            class="text-center border border-[#9d8461] rounded-md"
            name="email"
            placeholder="email@example.com"
            required
            type="email"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="password">Password</label>
          <input
            v-model="form.password"
            class="text-center border border-[#9d8461] rounded-md"
            name="password"
            placeholder="Password"
            required
            type="password"
          />
        </div>

        <FormButtons />
      </form>
    </FormLayout>
  </Layout>
</template>

<style scoped></style>
