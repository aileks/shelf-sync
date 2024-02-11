<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
import { defineEmits } from "vue";

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

const emit = defineEmits(["submit"]);
const handleSubmit = throttle(() => {
  emit("submit");
}, 1000);
</script>

<template>
  <Head title="Register" />

  <FormLayout>
    <h2 class="border-b border-bronze pb-1.5 text-2xl">Register</h2>

    <Form
      :form-fields="formFields"
      submit-text="Register"
      cancelUrl="/"
      postUrl="/register"
      @submit="handleSubmit"
    >
      <div class="mx-4 mt-6 flex items-center justify-end">
        <StyledButton type="submit">Register</StyledButton>
      </div>
    </Form>
  </FormLayout>
</template>
