<script setup lang="ts">
defineProps<{
    type?: 'button' | 'submit' | 'reset'
}>();
</script>

<template>
    <button 
        :type="type || 'button'"
        class="inline-flex items-center justify-center cursor-pointer px-3.5 py-1.5 text-white text-center bg-transparent border border-gray-300 rounded-md transition-all duration-200 ease-in-out hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
    >
        <slot />
    </button>
</template>
