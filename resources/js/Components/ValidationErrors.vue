<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const errors = computed(() => usePage().props.value.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div v-if="hasErrors">
        <div class="max-w-3xl mt-2 mx-auto sm:px-6 lg:px-8 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Something went wrong.</p>
            <p v-for="(error, key) in errors" :key="key">{{ error }}</p>
        </div>
    </div>
</template>
