<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: string
}>();
</script>

<template>
    <Link 
        :href="href"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    >
        <slot />
    </Link>
</template>
