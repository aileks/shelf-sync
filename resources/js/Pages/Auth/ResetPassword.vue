<script setup>
import Layout from "@/Components/Layout.vue";
import FormLayout from "@/Components/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
  errors: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Layout>
    <Head title="Reset Password" />

    <FormLayout>
      <h2 class="text-2xl border-bronze border-b pb-1.5">Reset Password</h2>

      <form @submit.prevent="submit">
        <div class="text-md flex flex-col mt-4 space-y-2 text-left">
          <label class="ml-1" for="password">New Password</label>
          <input
            v-model="form.password"
            class="border-bronze border rounded-md"
            name="password"
            placeholder="Password"
            required
            type="password"
          />
        </div>

        <div class="text-md flex flex-col mt-4 space-y-2 text-left">
          <label class="ml-1" for="password_confirmation"
            >Confirm Password</label
          >
          <input
            v-model="form.password_confirmation"
            class="border-bronze border rounded-md"
            name="password_confirmation"
            placeholder="Confirm Password"
            required
            type="password"
          />
          <div v-if="errors.password" class="error">
            {{ errors.password }}
          </div>
        </div>

        <div class="mt-4 space-x-10">
          <StyledButton type="submit">Reset</StyledButton>

          <StyledButton type="button">
            <Link href="/">Cancel</Link>
          </StyledButton>
        </div>
      </form>
    </FormLayout>
  </Layout>
</template>

<style scoped>
.error {
  text-align: center;
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
