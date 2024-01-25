<script setup>
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";
import StyledButton from "@/Shared/StyledButton.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  name: null,
  email: null,
  password: null,
});

const submit = () => {
  form.post("/register");
};
</script>

<template>
  <Head title="Register" />

  <Layout>
    <FormLayout>
      <h1 id="box-text" class="text-xl border-b pb-1.5">Register</h1>
      <form @submit.prevent="submit">
        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="name">Name</label>
          <input
            v-model="form.name"
            class="p-2 border rounded-md border-slate-200"
            name="name"
            placeholder="Name"
            required
            type="text"
          />
        </div>

        <div class="flex flex-col mt-4 space-y-2 text-md">
          <label for="email">Email</label>
          <input
            v-model="form.email"
            class="p-2 border rounded-md border-slate-200"
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
            class="p-2 border rounded-md border-slate-200"
            name="password"
            placeholder="Password"
            required
            type="password"
          />
        </div>

        <div class="mt-4 space-x-10">
          <StyledButton type="submit"> Submit </StyledButton>

          <StyledButton>
            <Link href="/">Cancel</Link>
          </StyledButton>
        </div>
      </form>
    </FormLayout>
  </Layout>
</template>
