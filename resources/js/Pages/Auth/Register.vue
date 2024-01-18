<script setup>
  import Form from '@/Shared/Form.vue';
  import FormLayout from '@/Shared/FormLayout.vue';
  import StyledButton from '@/Shared/StyledButton.vue';
  import {ref} from 'vue';

  let formFields = ref([
    {
      label: "First Name",
      placeholder: "First Name",
      name: "firstName",
      type: "text",
      model: "first_name",
    },
    {
      label: "Last Name",
      placeholder: "Last Name",
      name: "lastName",
      type: "text",
      model: "last_name",
    },
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
  <Head title="Register"/>

  <Layout>
    <FormLayout>
      <h1 id="box-text"
          class="text-xl border-b pb-1.5">Register</h1>

      <Form :formFields="formFields">
        <div class="space-x-10 mt-4">
          <StyledButton id="form-button"
                        type="submit">
            Submit
          </StyledButton>

          <StyledButton id="form-button">
            <Link href="/">
              Cancel
            </Link>
          </StyledButton>
        </div>
      </Form>
    </FormLayout>
  </Layout>
</template>

<style scoped>
  #box-text {
    border-color: rgb(232, 214, 203);
  }
</style>