<script setup>
  import StyledButton from "@/Shared/StyledButton.vue";
  import Form from "@/Shared/Form.vue";
  import {ref} from "vue";

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
    <h1 class="text-xl">Add a book!</h1>

    <div class="flex items-center justify-center h-1/2 mt-4">
      <div id="container"
           class="justify-center rounded-xl w-1/3 p-4 mb-2">
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

  #form-button {
    background-color: rgb(232, 214, 203);
  }

  #form-button:hover {
    background-color: rgba(232, 214, 203, 0.8);
  }
</style>