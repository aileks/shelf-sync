<script setup>
import StyledButton from "./StyledButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  formFields: Array,
});

const form = useForm(
  Object.fromEntries(props.formFields.map((field) => [field.model, null]))
);

const submit = () => {
  form.post("/login");
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
    </div>

    <div class="mt-8 space-x-12">
      <StyledButton class="bg-[#69442e] text-neutral-100" type="submit">
        Submit
      </StyledButton>

      <StyledButton class="bg-[#69442e] text-neutral-100">
        <Link href="/"> Cancel </Link>
      </StyledButton>
    </div>
    <slot />
  </form>
</template>
