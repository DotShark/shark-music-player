<script setup lang="ts">
defineProps<{
    modelValue: File | null;
    label: string;
    id: string;
    accept: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: File | null): void;
}>();

function handleFileChange(event: Event) {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0] || null;
    emit('update:modelValue', file);
}
</script>

<template>
    <div class="flex flex-col gap-2">
        <label :for="id" class="text-md font-medium text-gray-300">{{ label }}</label>
        <input 
            :id="id"
            type="file"
            :accept="accept"
            @change="handleFileChange"
            class="p-2 bg-gray-700 rounded text-gray-300"
        />
    </div>
</template>
