<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div
            class="w-full sm:max-w-[700px] mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg flex shadow-md gap-2 flex-wrap"
        >
        <slot />
        </div>
    </div>
</template>
