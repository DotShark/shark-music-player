<script setup lang="ts">
import type { Track } from '@/types/Track';

defineProps<{
    track: Track
}>();
</script>

<template>
    <li class="flex items-center gap-4 p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
        <div class="flex-shrink-0 w-12 h-12 rounded overflow-hidden bg-gray-700">
            <img 
                v-if="track.image"
                :src="`/storage/track-images/${track.image}`"
                alt=""
                class="w-full h-full object-cover"
            />
        </div>
        <div class="flex-grow">
            <h3 class="font-medium text-white">{{ track.title }}</h3>
            <p class="text-sm text-gray-400">{{ track.artist }}</p>
        </div>
        <div class="text-sm text-gray-400">
            Played {{ track.play_count }} times
        </div>
    </li>
</template>
