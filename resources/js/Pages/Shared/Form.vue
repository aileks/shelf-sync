<script setup>
defineProps({
  formFields: Object,
});
</script>

<template>
  <form>
    <div v-for="field in formFields"
         :key="field.model"
         class="mt-4 flex flex-col space-y-2 text-md">
      <label :for="field.label">{{ field.label }}</label>
      <input v-model="formFields[field.model]"
             :name="field.name"
             :placeholder="field.placeholder"
             :type="field.type"
             class="border border-slate-200 rounded-md p-2"
             required
      />
    </div>
    <slot/>
  </form>
</template>