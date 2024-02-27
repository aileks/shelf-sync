<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  formFields: Array,
  postUrl: String,
});

const form = useForm({
  ...Object.fromEntries(props.formFields.map((field) => [field.model, null])),
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
    <div v-for="(field, index) in props.formFields" :key="index">
      <div v-if="field.model !== 'remember'" class="flex flex-col">
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
      </div>

      <div
        v-else
        class="mt-6 flex items-center space-x-2 text-sm italic text-blue"
      >
        <input
          v-model="form[field.model]"
          :name="field.name"
          :placeholder="field.placeholder"
          :type="field.type"
          class="rounded"
        />

        <label :for="field.label" class="">{{ field.label }}</label>
      </div>

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
