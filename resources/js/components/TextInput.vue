<script setup lang="ts">
defineProps<{
    modelValue: string;
    label: string;
    id: string;
    error?: string;
}>();

defineEmits<{
    (e: 'update:modelValue', value: string): void;
}>();
</script>

<template>
    <div class="flex flex-col gap-2">
        <label :for="id" class="text-md font-medium text-gray-300">{{ label }}</label>
        <input 
            :id="id"
            type="text"
            :value="modelValue"
            @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
            class="p-2 bg-gray-700 rounded"
            :class="{ 'border border-red-500': error }"
        />
        <p v-if="error" class="text-sm text-red-500">{{ error }}</p>
    </div>
</template>
