<script setup>
  import Form from '@/Components/Form.vue';
  import FormLayout from '@/Layouts/FormLayout.vue';
  import StyledButton from '@/Components/StyledButton.vue';
  import { ref, watch, defineEmits } from 'vue';

  const props = defineProps({
    status: String,
  });

  let isProcessing = ref(false);

  const formFields = [
    {
      model: 'email',
      label: 'Email',
      name: 'email',
      type: 'email',
      placeholder: 'Email',
    },
    {
      model: 'password',
      label: 'Password',
      name: 'password',
      type: 'password',
      placeholder: 'Password',
    },
    {
      model: 'remember',
      label: 'Remember Me',
      name: 'remember',
      type: 'checkbox',
    },
  ];

  const status = ref(props.status);

  const remember = ref(false);

  watch(status, newStatus => {
    if (newStatus) {
      setTimeout(() => {
        status.value = null;
      }, 3000);
    }
  });

  const emit = defineEmits(['submit']);
  const handleSubmit = () => {
    isProcessing.value = true;
    emit('submit');
    isProcessing.value = false;
  };
</script>

<template>
  <Head title="Login" />

  <FormLayout>
    <h2 class="border-b border-bronze pb-1.5 text-3xl">Log In</h2>

    <Form
      :form-fields="formFields"
      :remember="remember"
      cancel-url="/"
      post-url="/login"
      submit-text="Login"
      @submit="handleSubmit"
    >
      <div class="mx-4 mt-6 flex flex-1 items-center justify-end">
        <StyledButton type="submit" :isProcessing="isProcessing">
          Log In
        </StyledButton>
      </div>
    </Form>

    <div class="mb-0 mt-8 flex items-center justify-center pb-0">
      <Link
        class="text-sm font-bold italic text-blue hover:underline"
        href="/forgot-password"
      >
        Forgot Password?
      </Link>
    </div>
  </FormLayout>

  <Transition
    enter-active-class="transition-opacity duration-700 ease-in-out"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
    leave-from-class="transform opacity-100"
    leave-to-class="transform opacity-0"
  >
    <div
      v-show="status"
      class="fixed bottom-0 right-0 m-6 max-w-xs overflow-hidden rounded-lg bg-green shadow-lg"
      @click="status = null"
    >
      <div class="p-4">
        <p class="text-neutral-50">{{ status }}</p>
      </div>
    </div>
  </Transition>
</template>
