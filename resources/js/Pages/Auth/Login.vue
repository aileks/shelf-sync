<script setup>
  import StyledButton from '@/Shared/StyledButton.vue';
  import Form from '@/Shared/Form.vue'
  import FormLayout from '@/Shared/FormLayout.vue';
  import {useForm} from "@inertiajs/vue3";

  let form = useForm({
    email: '',
    password: '',
  });

  let submit = () => {
    form.post('/login');
  }
</script>

<template>
  <Head title="Login"/>
  <Layout>
    <FormLayout>
      <p class="text-2xl mb-6">Welcome back to Quillify!</p>
      <h1
          class="text-xl border-[#E8D6CB] border-b pb-1.5">Login</h1>
      <form @submit.prevent="submit">
        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="email">Email</label>
          <input v-model="form.email"
                 class="border border-slate-200 rounded-md text-center"
                 name="email"
                 placeholder="email@example.com"
                 required
                 type="email"/>
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="password">Password</label>
          <input v-model="form.password"
                 class="border border-slate-200 rounded-md text-center"
                 name="password"
                 placeholder="Password"
                 required
                 type="password"/>
        </div>

        <div class="space-x-10 mt-4">
          <StyledButton class="hover:bg-[#E8D6CB] bg-[#AD6A6C] hover:text-black text-white"
                        type="submit">
            Submit
          </StyledButton>

          <StyledButton class="hover:bg-[#E8D6CB] bg-[#AD6A6C] hover:text-black text-white">
            <Link href="/">
              Cancel
            </Link>
          </StyledButton>
        </div>
      </form>
    </FormLayout>
  </Layout>
</template>

<style scoped>
</style>
