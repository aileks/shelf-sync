<script setup>
  import StyledButton from '@/Shared/StyledButton.vue';
  import Form from '@/Shared/Form.vue';
  import FormLayout from '@/Shared/FormLayout.vue';
  import {ref} from 'vue';

  let formFields = ref([
    {
      label: "Title",
      placeholder: "Title",
      name: "title",
      type: "text",
      model: "title",
    },
    {
      label: "Author",
      placeholder: "Author",
      name: "author",
      type: "text",
      model: "author",
    },
    {
      label: "Pages",
      placeholder: "Pages",
      name: "pages",
      type: "number",
      model: "pages",
    },
    {
      label: "Genre",
      placeholder: "Genre",
      name: "genre",
      type: "text",
      model: "genre",
    },
    {
      label: "Publish Date",
      placeholder: "Publish Date",
      name: "publish_date",
      type: "date",
      model: "publish_date",
    },
  ]);
</script>

<template>
  <Head title="Add a Book"/>

  <Layout>
    <FormLayout>
      <h1 id="box-text"
          class="text-xl border-b pb-1.5">Add Book</h1>

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
    </FormLayout>
  </Layout>
</template>

<style scoped>
  #box-text {
    border-color: rgb(232, 214, 203);
  }
</style>