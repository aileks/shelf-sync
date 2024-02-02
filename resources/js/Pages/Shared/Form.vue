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
      class="text-md flex flex-col mt-4 space-y-2"
    >
      <label :for="field.label">{{ field.label }}</label>

      <input
        v-model="form[field.model]"
        class="border-bronze text-center border rounded-md"
        :name="field.name"
        :placeholder="field.placeholder"
        :type="field.type"
        required
      />
      <div v-if="form.errors[field.model]" class="error">
        {{ form.errors[field.model] }}
      </div>
    </div>

    <FormButtons :submit-text="props.submitText" :cancelUrl="props.cancelUrl" />
    <slot />
  </form>
</template>

<style scoped>
.error {
  color: darkred;
  font-size: 14px;
  font-style: italic;
}
</style>
