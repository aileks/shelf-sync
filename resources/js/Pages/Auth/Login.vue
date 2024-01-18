<script setup>
  import StyledButton from "@/Shared/StyledButton.vue";
  import Form from '@/Shared/Form.vue'
  import {ref} from "vue";

  let formFields = ref([
    {
      label: "Email",
      placeholder: "Email",
      name: "email",
      type: "email",
      model: "email",
    },
    {
      label: "Password",
      placeholder: "Password",
      name: "password",
      type: "password",
      model: "password",
    },
  ]);
</script>

<template>
  <Head title="Login"/>

  <Layout>
    <div class="flex items-center justify-center h-screen">
      <div id="container"
           class="rounded-xl w-1/4 p-4 mb-2">
        <h1 id="box-text"
            class="text-xl border-b pb-1.5">Login</h1>
        <Form :formFields="formFields">
          <div class="space-x-10 mt-4">
            <StyledButton id="form-button"
                          type="submit">
              Submit
            </StyledButton>

            <StyledButton id="form-button">
              <Link href="/">
                Home
              </Link>
            </StyledButton>
          </div>
        </Form>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
  #container {
    background-color: rgb(208, 173, 167);
  }

  #box-text {
    border-color: rgb(232, 214, 203);
  }
</style>