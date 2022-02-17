<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import MainNav from '@/Components/MainNav.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
})

</script>

<template>
    <div >
        <MainNav :canLogin="canLogin" :canRegister="canRegister"></MainNav>
        <slot />
    </div>
</template>
