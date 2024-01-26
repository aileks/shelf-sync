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
      <h2 class="text-xl border-[#9d8461] border-b pb-1.5">Login</h2>

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
