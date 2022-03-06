<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps(['modelValue','options']);

defineEmits(['update:modelValue']);

</script>

<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
        <option value=""></option>
        <option v-for="option in props.options" :key="option.id" :value="option.id">{{option.name}}</option>
    </select>
</template>
