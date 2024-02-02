<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Form from "@/Shared/Form.vue";
import StyledButton from "@/Shared/StyledButton.vue";

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
    <div class="max-w-[60vh] flex items-center justify-center mx-auto mt-8">
      <div
        class="bg-sandy border-bronze shadow-paper p-8 text-lg border rounded-lg"
      >
        <h2 class="text-2xl border-bronze border-b pb-1.5">
          Reset Your Password
        </h2>

        <p class="mt-2 text-center">
          Please enter your email address and we will send you a link to reset
          your password.
        </p>

        <form @submit.prevent="submit">
          <div class="text-md flex flex-col w-64 mx-auto mt-4">
            <input
              v-model="form.email"
              class="border-bronze text-left border rounded-md"
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

        <div class="text-blue pt-2 mt-4 italic" v-show="status">
          {{ status }}
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
.error {
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
