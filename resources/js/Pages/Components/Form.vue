<script setup>
import { useForm } from "@inertiajs/vue3";
import { inject } from "vue";

const props = defineProps({
  formFields: Array,
  postUrl: String,
  remember: Boolean,
});

const form = useForm({
  ...Object.fromEntries(props.formFields.map((field) => [field.model, null])),
  remember: props.remember,
});

const submit = () => {
  const options = {
    preserveState: true,
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
      <label :for="field.label" class="mb-1 ml-1 mt-3"
        >{{ field.label }}:</label
      >

      <input
        v-model="form[field.model]"
        :name="field.name"
        :placeholder="field.placeholder"
        :type="field.type"
        class="rounded-md border border-bronze"
        required
      />

      <div
        v-if="form.errors[field.model]"
        class="error mt-3 text-center text-sm italic text-red"
      >
        {{ form.errors[field.model] }}
      </div>
    </div>

    <slot />
  </form>
</template>
