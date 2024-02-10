<script setup>
import Form from "@/Components/Form.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import StyledButton from "@/Components/StyledButton.vue";
import { ref, watch } from "vue";

const props = defineProps({
  status: String
});

const formFields = [
  {
    model: "email",
    label: "Email",
    name: "email",
    type: "email",
    placeholder: "Email"
  },
  {
    model: "password",
    label: "Password",
    name: "password",
    type: "password",
    placeholder: "Password"
  }
];

const status = ref(props.status);

const remember = ref(false);

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


    <Form :form-fields="formFields" :remember="remember" cancel-url="/" post-url="/login" submit-text="Login"
      @submit="$emit('submit')">
      <div class="flex items-center justify-between flex-1 mx-4 mt-6">
        <div class="flex items-center space-x-2">
          <input v-model="remember" class="rounded" type="checkbox" />
          <label class="text-base text-blue" for="remember">Remember Me</label>
        </div>

        <StyledButton type="submit">Log In</StyledButton>
      </div>
    </Form>

  </FormLayout>

  <div class="flex justify-center pb-0 mt-4 mb-0">
    <Link class="text-sm italic font-bold text-blue hover:underline" href="/forgot-password">
    Forgot Password?
    </Link>
  </div>
  <Transition enter-active-class="transition-opacity duration-700 ease-in-out" enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100" leave-from-class="transform opacity-100" leave-to-class="transform opacity-0">
    <div v-show="status" class="fixed bottom-0 right-0 max-w-xs m-6 overflow-hidden rounded-lg shadow-lg bg-emerald-700"
      @click="status = null">
      <div class="p-4">
        <p class="text-neutral-50 ">{{ status }}</p>
      </div>
    </div>
  </Transition>
</template>
