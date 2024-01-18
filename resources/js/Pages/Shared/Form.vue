<script setup>
  defineProps({
    formFields: Array,
  });
</script>

<template>
  <form>
    <div v-for="field in formFields"
         class="mt-4 flex flex-col space-y-2 text-md">
      <label :for="field.label">{{ field.label }}</label>
      <input v-model="field.model.value"
             :name="field.name"
             :placeholder="field.placeholder"
             :type="field.type"
             class="border border-slate-200 rounded-md p-2"/>
    </div>
    <slot/>
  </form>
</template>