<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: string
}>();
</script>

<template>
    <Link 
        :href="href"
        class="inline-flex items-center justify-center cursor-pointer px-3.5 py-1.5 text-white text-center bg-transparent border border-gray-300 rounded-md transition-all duration-200 ease-in-out hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
    >
        <slot />
    </Link>
</template>
