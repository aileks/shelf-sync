<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
import { ref, watch } from "vue";

const props = defineProps({
  status: String,
});

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

const status = ref(props.status);

watch(status, (newStatus) => {
  if (newStatus) {
    setTimeout(() => {
      status.value = null;
    }, 3000);
  }
});
</script>

<template>
  <Head title="Login" />

  <FormLayout>
    <h2 class="text-3xl border-bronze border-b pb-1.5">Log In</h2>


    <Form
      :form-fields="formFields"
      submit-text="Login"
      cancel-url="/"
      post-url="/login"
      @submit="$emit('submit')"
    >
      <div class="flex items-center justify-between mx-4 mt-6">
        <Link
          href="/forgot-password"
          class="text-blue text-sm italic hover:underline"
        >
          Forgot Password?
        </Link>

        <StyledButton type="submit">Login</StyledButton>
      </div>
    </Form>
  </FormLayout>

  <Transition
    enter-active-class="transition-opacity duration-700 ease-in-out"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
    leave-from-class="transform opacity-100"
    leave-to-class="transform opacity-0"
  >
    <div class="fixed bottom-0 right-0 m-6 bg-emerald-700 rounded-lg shadow-lg overflow-hidden max-w-xs" v-show="status" @click="status = null">
      <div class="p-4">
        <p class="text-neutral-50 ">{{ status }}</p>
      </div>
    </div>
  </Transition>
</template>
