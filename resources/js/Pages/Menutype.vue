<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import FlashMessages from "@/Components/FlashMessages.vue";

const props = defineProps({
  user: Object,
  status: String,
});

const menu_type_form = useForm({
  name: props.name,
});

function menu_type_submit() {
  prof_form.post(route('menu_type.store'));
}

</script>

<template>
  <BreezeAuthenticatedLayout>
    <Head title="Menu Type" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Menu Type
      </h2>
    </template>
    
    <BreezeValidationErrors />

    <FlashMessages />

  </BreezeAuthenticatedLayout>
</template>
