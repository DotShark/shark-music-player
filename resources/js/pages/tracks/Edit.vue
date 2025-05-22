<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import OutlinedButton from '@/components/OutlinedButton.vue';
import TextInput from '@/components/TextInput.vue';
import ToggleSwitch from '@/components/ToggleSwitch.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Track } from '@/types/Track';

type Props = {
    track: Track
};
const props = defineProps<Props>();

const form = useForm({
    title: props.track.title,
    artist: props.track.artist,
    displayed: props.track.displayed,
});

function submit() {
    form.patch(route('tracks.update', props.track.uuid));
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
                <OutlinedButton type="submit" :disabled="form.processing">
                    Update
                </OutlinedButton>
            </form>
        </template>
    </MusicLayout>
</template>
