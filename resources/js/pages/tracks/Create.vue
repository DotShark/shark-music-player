<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import OutlinedButton from '@/components/OutlinedButton.vue';
import TextInput from '@/components/TextInput.vue';
import ToggleSwitch from '@/components/ToggleSwitch.vue';
import FileInput from '@/components/FileInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    artist: '',
    displayed: false,
    file: null as File | null,
    image: null as File | null,
});

function submit() {
    form.post(route('tracks.store'));
}
</script>

<template>
    <Head title="Tracks" />

    <MusicLayout>
        <template #title>Add a track</template>
        <template #action>
            <OutlinedLink :href="route('tracks.index')">
                Return to tracks
            </OutlinedLink>
        </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-4 p-8">
                <TextInput
                    id="title"
                    label="Title"
                    v-model="form.title"
                    :error="form.errors.title"
                />
                <TextInput
                    id="artist"
                    label="Artist"
                    v-model="form.artist"
                    :error="form.errors.artist"
                />
                <ToggleSwitch
                    id="displayed"
                    label="Displayed"
                    v-model="form.displayed"
                    :error="form.errors.displayed"
                />
                <FileInput
                    id="file"
                    label="Music File"
                    accept="audio/*"
                    v-model="form.file"
                    :error="form.errors.file"
                />
                <FileInput
                    id="image"
                    label="Cover Image"
                    accept="image/*"
                    v-model="form.image"
                    :error="form.errors.image"
                />
                <OutlinedButton type="submit" :disabled="form.processing">
                    Create
                </OutlinedButton>
            </form>
        </template>
    </MusicLayout>
</template>
