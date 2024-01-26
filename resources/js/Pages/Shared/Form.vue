<script setup>
import { useForm } from "@inertiajs/vue3";
import FormButtons from "./FormButtons.vue";

const props = defineProps({
  formFields: Array,
  submitText: String,
  cancelUrl: String,
  postUrl: String,
});

const form = useForm(
  Object.fromEntries(props.formFields.map((field) => [field.model, null]))
);

const submit = () => {
  form.post(props.postUrl, {
    preserveState: true,
  });
};
</script>

<template>
  <form @submit.prevent="submit">
    <div
      v-for="(field, index) in props.formFields"
      :key="index"
      class="flex flex-col mt-4 space-y-2 text-md"
    >
      <label :for="field.label">{{ field.label }}</label>

      <input
        v-model="form[field.model]"
        class="text-center border border-[#9d8461] rounded-md"
        :name="field.name"
        :placeholder="field.placeholder"
        :type="field.type"
        required
      />
      <div v-if="form.errors[field.model]" class="text-red-500">
        {{ form.errors[field.model] }}
      </div>
    </div>

    <FormButtons :submit-text="props.submitText" :cancelUrl="props.cancelUrl" />
    <slot />
  </form>
</template>
