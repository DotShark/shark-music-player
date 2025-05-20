<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const form = reactive({
    title: '',
    artist: '',
    displayed: false,
    file: null as File | null,
    image: null as File | null,
    progress: null as number | null,
});

function handleFileChange(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        form.file = target.files[0];
    }
}

function handleImageChange(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        form.image = target.files[0];
    }
}

function submit() {
    router.post(route('tracks.store'), form, { forceFormData: true });
}
</script>

<template>
    <Head title="Tracks" />

    <MusicLayout>
        <template #title>Add a track</template>
        <template #action>
            <PrimaryButton :href="route('tracks.index')">
                Return to tracks
            </PrimaryButton>
        </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-4 p-8">
                <div class="flex flex-col gap-2">
                    <label for="title" class="text-md font-medium text-gray-300">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        v-model="form.title" 
                        class="p-2 bg-gray-700 rounded"
                    />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="artist" class="text-md font-medium text-gray-300">Artist</label>
                    <input 
                        type="text" 
                        id="artist" 
                        v-model="form.artist" 
                        class="p-2 bg-gray-700 rounded"
                    />
                </div>
                <div class="flex items-center gap-2">
                    <label for="displayed" class="text-md font-medium text-gray-300">Displayed</label>
                    <button 
                        type="button"
                        role="switch"
                        :aria-checked="form.displayed"
                        @click="form.displayed = !form.displayed"
                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 ease-in-out"
                        :class="form.displayed ? 'bg-blue-500' : 'bg-gray-700'"
                    >
                        <span 
                            class="inline-block h-4 w-4 transform rounded-full bg-white transition duration-200 ease-in-out"
                            :class="form.displayed ? 'translate-x-6' : 'translate-x-1'"
                        />
                    </button>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="file" class="text-md font-medium text-gray-300">Music File</label>
                    <input 
                        type="file" 
                        id="file"
                        @change="handleFileChange"
                        accept="audio/*"
                        class="p-2 bg-gray-700 rounded text-gray-300"
                    />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="image" class="text-md font-medium text-gray-300">Cover Image</label>
                    <input 
                        type="file" 
                        id="image"
                        @change="handleImageChange"
                        accept="image/*"
                        class="p-2 bg-gray-700 rounded text-gray-300"
                    />
                </div>
                <button type="submit" class="p-2 bg-blue-500 rounded">Create</button>
            </form>
        </template>
    </MusicLayout>
</template>
