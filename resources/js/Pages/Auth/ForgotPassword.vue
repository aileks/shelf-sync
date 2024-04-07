<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Form from "@/Components/Form.vue";
import StyledButton from "@/Components/StyledButton.vue";

defineProps({
  errors: Object,
  status: String,
});

const form = useForm({
  email: null,
});

const isSubmitted = ref(false);

const submit = () => {
  form.post("/forgot-password", {
    onFinish: () => {
      isSubmitted.value = true;
    },
  });
};
</script>

<template>
  <Head title="Password Reset" />

  <Layout>
    <div class="mx-auto mt-8 flex max-w-[60vh] items-center justify-center">
      <div
        class="rounded-lg border border-bronze bg-sandy p-8 text-lg shadow-paper"
      >
        <h2 class="border-b border-bronze pb-1.5 text-2xl">
          Reset Your Password
        </h2>

        <p class="mt-2 text-center">
          Please enter your email address and we will send you a link to reset
          your password.
        </p>

        <form @submit.prevent="submit">
          <div class="text-md mx-auto mt-4 flex w-64 flex-col">
            <input
              v-model="form.email"
              class="rounded-md border border-bronze text-left"
              name="email"
              placeholder="Email"
              type="email"
              required
            />
            <div class="error mt-4" v-if="errors.email">
              {{ errors.email }}
            </div>
          </div>

          <div class="mt-6 space-x-10">
            <StyledButton type="submit">Submit</StyledButton>

            <StyledButton type="button">
              <Link href="/">Cancel</Link>
            </StyledButton>
          </div>
        </form>

        <div class="mt-4 pt-2 italic text-blue" v-show="status">
          {{ status }}
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped></style>
