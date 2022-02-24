<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head,useForm } from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import FlashMessages from '@/Components/FlashMessages.vue';

const props = defineProps({
  user: Object,
  status: String,
});

const prof_form = useForm({
  name: props.user.name,
  about: props.user.about,
  contact: props.user.contact,
});

function prof_submit() {
  prof_form.post(route('profile.update'));
}

const cred_form = useForm({
  password: '',
  password_confirmation: '',
  old_password: '',
});

function cred_submit() {
  cred_form.post(route('password.change'), {
      onFinish: () => resetPassword(),
  });
}

function resetPassword(){
  cred_form.password = "",
  cred_form.password_confirmation = '',
  cred_form.old_password = ''
}
</script>

<template>
  <BreezeAuthenticatedLayout>

    <Head title="Profile" />

    <BreezeValidationErrors />

    <FlashMessages/>

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
      </h2>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="prof_submit">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Profile Information</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">your business profile.</p>
            </div>
            <div class="border-t border-gray-200">
              <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Business name</dt>
                  <BreezeInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="prof_form.name"
                  />
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">About</dt><BreezeInput
                    id="about"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="prof_form.about"
                  />
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Email address</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ user.email }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Contact</dt>
                  <BreezeInput
                    id="contact"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="prof_form.contact"
                  />
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Account created at</dt>
                  <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">{{ user.created_at }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Last modified at</dt>
                  <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2">{{ user.updated_at }}</dd>
                </div>
              </dl>
            </div>
            <div class="px-4 py-5 sm:px-6">
              <BreezeButton
                :class="{ 'opacity-25': prof_form.processing }"
                :disabled="prof_form.processing"
              >
                Update Profile
              </BreezeButton>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="cred_submit">
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">Credentials</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">your credentials.</p>
            </div>
            <div class="border-t border-gray-200">
              <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">New Password</dt>
                  <BreezeInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="cred_form.password"
                  />
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Retype new password</dt>
                  <BreezeInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="cred_form.password_confirmation"
                  />
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-500">Current password</dt>
                  <BreezeInput
                    id="old_password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="cred_form.old_password"
                  />
                </div>
              </dl>
            </div>
            <div class="px-4 py-5 sm:px-6">
              <BreezeButton
                :class="{ 'opacity-25': cred_form.processing }"
                :disabled="cred_form.processing"
              >
                Update Password
              </BreezeButton>
            </div>
          </div>
        </form>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
