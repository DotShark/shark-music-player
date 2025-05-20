<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import TrackItem from '@/components/Track.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import type { Track } from '@/types/Track';
import { ref, onUnmounted } from 'vue';

type Props = {
    tracks: Track[]
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
    const track = props.tracks.find(t => t.uuid === trackId);
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

    <Head title="Tracks" />

    <MusicLayout>
        <template #title>Tracks</template>
        <template #action>
            <PrimaryButton :href="route('tracks.create')">
                Add a track
            </PrimaryButton>
        </template>
        <template #content>
            <ul class="grid gap-2 p-8">
                <TrackItem v-for="track in tracks" :key="track.uuid" :track="track"
                    :is-playing="currentTrackId === track.uuid && !audio?.paused"
                    :progress="currentTrackId === track.uuid ? progress : 0" @toggle-play="handleTogglePlay" />
            </ul>
        </template>
    </MusicLayout>
</template>
