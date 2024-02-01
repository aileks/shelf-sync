<script setup>
import Form from "@/Shared/Form.vue";
import FormLayout from "@/Shared/FormLayout.vue";

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

  <Layout>
    <FormLayout>
      <h2 class="text-2xl border-bronze border-b pb-1.5">Log In</h2>

      <Form
        :form-fields="formFields"
        submit-text="Login"
        cancel-url="/"
        post-url="/login"
        @submit="$emit('submit')"
      />
    </FormLayout>
  </Layout>
</template>

<style scoped></style>
