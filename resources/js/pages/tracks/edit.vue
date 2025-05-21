<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import ToggleSwitch from '@/components/ToggleSwitch.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Track } from '@/types/Track';
import { router } from '@inertiajs/vue3';

type Props = {
    track: Track
};
const props = defineProps<Props>();

const form = reactive({
    title: props.track.title,
    artist: props.track.artist,
    displayed: props.track.displayed,
});

function submit() {
    router.patch(route('tracks.update', props.track.uuid), form );
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
                <button type="submit" class="p-2 bg-blue-500 rounded cursor-pointer">Update</button>
            </form>
        </template>
    </MusicLayout>
</template>
