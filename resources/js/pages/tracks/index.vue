<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import TrackListItem from '@/components/TrackListItem.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import type { Track } from '@/types/Track';

type Props = {
  tracks: Track[]
}

defineProps<Props>();
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
                <TrackListItem 
                    v-for="track in tracks" 
                    :key="track.uuid" 
                    :track="track"
                />
            </ul>
        </template>
    </MusicLayout>
</template>
