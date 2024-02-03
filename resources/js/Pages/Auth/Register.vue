<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";

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
    />
  </FormLayout>
</template>
