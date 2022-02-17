<template>
  <MainNav :canLogin="canLogin" :canRegister="canRegister"></MainNav>
</template>

<script setup>
import MainNav from '@/Components/MainNav.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
})

</script>
