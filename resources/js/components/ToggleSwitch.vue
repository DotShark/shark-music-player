<script setup lang="ts">
defineProps<{
    modelValue: boolean;
    label: string;
    id: string;
    error?: string;
}>();

defineEmits<{
    (e: 'update:modelValue', value: boolean): void;
}>();
</script>

<template>
    <div class="flex items-center gap-2">
        <label :for="id" class="text-md font-medium text-gray-300">{{ label }}</label>
        <button 
            type="button"
            role="switch"
            :id="id"
            :aria-checked="modelValue"
            @click="$emit('update:modelValue', !modelValue)"
            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 ease-in-out"
            :class="modelValue ? 'bg-blue-500' : 'bg-gray-700'"
        >
            <span 
                class="inline-block h-4 w-4 transform rounded-full bg-white transition duration-200 ease-in-out"
                :class="modelValue ? 'translate-x-6' : 'translate-x-1'"
            />
        </button>
        <p v-if="error" class="text-sm text-red-500">{{ error }}</p>
    </div>
</template>
