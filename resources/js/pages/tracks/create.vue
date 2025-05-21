<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import ToggleSwitch from '@/components/ToggleSwitch.vue';
import FileInput from '@/components/FileInput.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const form = reactive({
    title: '',
    artist: '',
    displayed: false,
    file: null as File | null,
    image: null as File | null,
});

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
                <TextInput
                    id="title"
                    label="Title"
                    v-model="form.title"
                />
                <TextInput
                    id="artist"
                    label="Artist"
                    v-model="form.artist"
                />
                <ToggleSwitch
                    id="displayed"
                    label="Displayed"
                    v-model="form.displayed"
                />
                <FileInput
                    id="file"
                    label="Music File"
                    accept="audio/*"
                    v-model="form.file"
                />
                <FileInput
                    id="image"
                    label="Cover Image"
                    accept="image/*"
                    v-model="form.image"
                />
                <button type="submit" class="p-2 bg-blue-500 rounded cursor-pointer">Create</button>
            </form>
        </template>
    </MusicLayout>
</template>
