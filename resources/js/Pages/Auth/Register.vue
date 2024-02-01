<script setup>
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";
import FormButtons from "../Shared/FormButtons.vue";

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
    placeholder: "Password",
  },
];
</script>

<template>
  <Head title="Register" />

  <Layout>
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
  </Layout>
</template>
