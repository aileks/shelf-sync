<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  formFields: Array,
  postUrl: String,
  remember: Boolean
});

const form = useForm({
  ...Object.fromEntries(props.formFields.map((field) => [field.model, null])),
  remember: props.remember
});

const submit = () => {
  const options = {
    preserveState: true
  };

  form.post(props.postUrl, options);
};
</script>

<template>
  <form @submit.prevent="submit">
    <div
      v-for="(field, index) in props.formFields"
      :key="index"
      class="flex flex-col"
    >
      <label :for="field.label"
             class="mt-3 mb-1 ml-1"
      >{{ field.label }}:</label
      >

      <input
        v-model="form[field.model]"
        :name="field.name"
        :placeholder="field.placeholder"
        :type="field.type"
        class="border-bronze border rounded-md"
        required
      />

      <div v-if="form.errors[field.model]"
           class="error italic text-sm text-red mt-3 text-center">
        {{ form.errors[field.model] }}
      </div>
    </div>

    <slot />
  </form>
</template>