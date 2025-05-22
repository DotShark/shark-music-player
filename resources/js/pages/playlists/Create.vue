<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import OutlinedButton from '@/components/OutlinedButton.vue';
import TextInput from '@/components/TextInput.vue';
import ToggleTrackInPlaylist from '@/components/ToggleTrackInPlaylist.vue';
import { Head, useForm } from '@inertiajs/vue3';
import type { Track } from '@/types/Track';

type Props = {
    tracks: Track[]
}

defineProps<Props>();

const form = useForm({
    title: '',
    tracks: [] as string[],
});

function submit() {
    form.post(route('playlists.store'));
}

const toggleTrack = (trackUuid: string) => {
    const index = form.tracks.indexOf(trackUuid);
    if (index === -1) {
        form.tracks.push(trackUuid);
    } else {
        form.tracks.splice(index, 1);
    }
};
</script>

<template>
    <Head title="Create Playlist" />

    <MusicLayout>
        <template #title>Create a playlist</template>
        <template #action>
            <OutlinedLink :href="route('playlists.index')">
                Return to playlists
            </OutlinedLink>
        </template>
        <template #content>
            <form @submit.prevent="submit" class="flex flex-col gap-4 p-8">
                <TextInput
                    id="title"
                    label="Playlist Title"
                    v-model="form.title"
                    :error="form.errors.title"
                />

                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Select Tracks</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <ToggleTrackInPlaylist
                            v-for="track in tracks"
                            :key="track.uuid"
                            :track="track"
                            :is-in-playlist="form.tracks.includes(track.uuid)"
                            @toggle-in-playlist="toggleTrack"
                        />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    </div>
                    <p v-if="form.errors.tracks" class="mt-2 text-sm text-red-500">
                        {{ form.errors.tracks }}
                    </p>
                </div>

                <OutlinedButton type="submit" :disabled="form.processing">
                    Create Playlist
                </OutlinedButton>
            </form>
        </template>
    </MusicLayout>
</template>
