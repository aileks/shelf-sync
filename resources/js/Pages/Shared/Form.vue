<script setup>
defineProps({
  formFields: Object,
});
</script>

<template>
  <form>
    <div
      v-for="field in formFields"
      :key="field.model"
      class="flex flex-col mt-4 space-y-2 text-md"
    >
      <label :for="field.label">{{ field.label }}</label>
      <input
        v-model="formFields[field.model]"
        :name="field.name"
        :placeholder="field.placeholder"
        :type="field.type"
        required
      />
    </div>
    <slot />
  </form>
</template>
