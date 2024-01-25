<script setup>
  import Form from '@/Shared/Form.vue';
  import FormLayout from '@/Shared/FormLayout.vue';
  import StyledButton from "@/Shared/StyledButton.vue";
  import {useForm} from '@inertiajs/vue3';

  const form = useForm({
    name: null,
    email: null,
    password: null,
  });

  const submit = () => {
    form.post('/register');
  }
</script>

<template>
  <Head title="Register"/>

  <Layout>
    <FormLayout>
      <h1 id="box-text"
          class="text-xl border-b pb-1.5">Register</h1>
      <form @submit.prevent="submit">
        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="name">Name</label>
          <input v-model="form.name"
                 class="border border-slate-200 rounded-md p-2"
                 name="name"
                 placeholder="Name"
                 required
                 type="text"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="email">Email</label>
          <input v-model="form.email"
                 class="border border-slate-200 rounded-md p-2"
                 name="email"
                 placeholder="email@example.com"
                 required
                 type="email"
          />
        </div>

        <div class="mt-4 flex flex-col space-y-2 text-md">
          <label for="password">Password</label>
          <input v-model="form.password"
                 class="border border-slate-200 rounded-md p-2"
                 name="password"
                 placeholder="Password"
                 required
                 type="password"
          />
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
