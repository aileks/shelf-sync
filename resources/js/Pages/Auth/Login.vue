<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";

defineProps({
  status: String,
});

const formFields = [
  {
    model: "email",
    label: "Email",
    name: "email",
    type: "email",
    placeholder: "Email",
  },
  {
    model: "password",
    label: "Password",
    name: "password",
    type: "password",
    placeholder: "Password",
  },
];
</script>

<template>
  <Head title="Login" />

  <FormLayout>
    <h2 class="text-3xl border-bronze border-b pb-1.5">Log In</h2>

    <div class="text-blue pt-2 mt-4 italic" v-show="status">
      {{ status }}
    </div>

    <Form
      :form-fields="formFields"
      submit-text="Login"
      cancel-url="/"
      post-url="/login"
      @submit="$emit('submit')"
    >
      <div class="flex items-center justify-end mx-4 mt-6">
        <!-- <Link -->
        <!--   href="/forgot-password" -->
        <!--   class="text-blue text-sm italic hover:underline" -->
        <!-- > -->
        <!--   Forgot Password? -->
        <!-- </Link> -->

        <StyledButton type="submit">Login</StyledButton>
      </div>
    </Form>
  </FormLayout>
</template>

<style scoped></style>
