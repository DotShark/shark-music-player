<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
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
        <template #action>Action</template>
        <template #content>
            <ul class="pb-8">
                <li v-for="track in tracks" :key="track.uuid" class="mx-8 list-disc">
                    {{ track.title }} - {{ track.artist }}
                </li>
            </ul>
        </template>
    </MusicLayout>
</template>
