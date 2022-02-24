<script setup>
</script>

<template>
    <div v-if="$page.props.flash.message" class="max-w-3xl mt-2 mx-auto sm:px-6 lg:px-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
        <p> {{ $page.props.flash.message }} </p>
    </div>
</template>
