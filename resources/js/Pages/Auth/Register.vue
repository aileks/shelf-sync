<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";

const formFields = [
  {
    model: "name",
    label: "Name",
    name: "name",
    type: "text",
    placeholder: "Name",
  },
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
  {
    model: "password_confirmation",
    label: "Confirm Password",
    name: "password_confirmation",
    type: "password",
    placeholder: "Confirm Password",
  },
];
</script>

<template>
  <Head title="Register" />

  <FormLayout>
    <h2 class="text-2xl border-bronze border-b pb-1.5">Register</h2>

    <Form
      :form-fields="formFields"
      submit-text="Register"
      cancelUrl="/"
      postUrl="/register"
      @submit="$emit('submit')"
    >
      <div class="flex items-center justify-between mx-4 mt-6">
        <Link href="/" class="text-blue text-sm hover:underline">
          Change your mind?
        </Link>

        <StyledButton type="submit">Register</StyledButton>
      </div>
    </Form>
  </FormLayout>
</template>
