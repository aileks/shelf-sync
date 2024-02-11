<script setup>
import FormLayout from "@/Layouts/FormLayout.vue";
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
  <Head title="Reset Password" />

  <FormLayout>
    <h2 class="border-b border-bronze pb-1.5 text-2xl">Reset Password</h2>

    <form method="post" @submit.prevent="submit">
      <div class="text-md mt-4 flex flex-col space-y-2 text-left">
        <label class="ml-1" for="password">New Password</label>
        <input
          v-model="form.password"
          class="rounded-md border border-bronze"
          name="password"
          placeholder="Password"
          required
          type="password"
        />
      </div>

      <div class="text-md mt-4 flex flex-col space-y-2 text-left">
        <label class="ml-1" for="password_confirmation">Confirm Password</label>
        <input
          v-model="form.password_confirmation"
          class="rounded-md border border-bronze"
          name="password_confirmation"
          placeholder="Confirm Password"
          required
          type="password"
        />
        <div v-if="errors.password" class="error">
          {{ errors.password }}
        </div>
      </div>

      <div class="mx-4 mt-6 flex items-center justify-between">
        <StyledButton type="submit">Reset</StyledButton>

        <StyledButton type="button">
          <Link href="/">Cancel</Link>
        </StyledButton>
      </div>
    </form>
  </FormLayout>
</template>

<style scoped>
.error {
  text-align: center;
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
