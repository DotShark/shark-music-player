<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import TrackItem from '@/components/Track.vue';
import { Head } from '@inertiajs/vue3';
import type { Playlist } from '@/types/Playlist';
import type { Track } from '@/types/Track';
import { ref, onUnmounted } from 'vue';

type Props = {
    playlist: Playlist & {
        tracks: Track[]
    }
}

const props = defineProps<Props>();

const audio = ref<HTMLAudioElement | null>(null);
const progress = ref(0);
const currentTrackId = ref<string | null>(null);

const updateProgress = () => {
    if (audio.value) {
        progress.value = (audio.value.currentTime / audio.value.duration) * 100;
    }
};

const handleTogglePlay = (trackId: string) => {
    const track = props.playlist.tracks.find(t => t.uuid === trackId);
    if (!track) return;

    if (currentTrackId.value === trackId) {
        if (audio.value?.paused) {
            audio.value.play();
        } else {
            audio.value?.pause();
        }
        return;
    }

    if (audio.value) {
        audio.value.pause();
        audio.value.removeEventListener('timeupdate', updateProgress);
    }

    audio.value = new Audio(`/storage/tracks/${track.file_name}`);
    audio.value.addEventListener('timeupdate', updateProgress);
    audio.value.addEventListener('ended', () => {
        currentTrackId.value = null;
        progress.value = 0;
    });
    audio.value.play();
    currentTrackId.value = trackId;
};

onUnmounted(() => {
    if (audio.value) {
        audio.value.removeEventListener('timeupdate', updateProgress);
        audio.value.pause();
    }
});
</script>

<template>
    <Head :title="playlist.title" />

    <MusicLayout>
        <template #title>{{ playlist.title }}</template>
        <template #action>
            <OutlinedLink :href="route('playlists.index')">
                All playlists
            </OutlinedLink>
        </template>
        <template #content>
            <div class="flex flex-col p-8 gap-4">
                <div v-if="playlist.tracks.length === 0" class="text-center text-gray-500">
                    This playlist is empty.
                </div>
                <ul v-else class="flex flex-col gap-2">
                    <TrackItem 
                        v-for="track in playlist.tracks" 
                        :key="track.uuid" 
                        :track="track"
                        :is-playing="currentTrackId === track.uuid && !audio?.paused"
                        :progress="currentTrackId === track.uuid ? progress : 0"
                        @toggle-play="handleTogglePlay"
                    />
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>
