<script setup lang="ts">
import type { Track } from '@/types/Track';
import { Play, Pause, Pencil, Trash } from 'lucide-vue-next';
import { Link, router } from '@inertiajs/vue3';

defineProps<{
    track: Track,
    isPlaying: boolean,
    progress: number
}>();

const emit = defineEmits<{
    'toggle-play': [trackId: string]
}>();

const deleteTrack = (trackId: string) => {
    if (confirm('Are you sure you want to delete this track?')) {
        router.delete(route('tracks.destroy', trackId));
    }
};
</script>

<template>
    <li class="flex items-center gap-4 p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
        <button 
            @click="emit('toggle-play', track.uuid)" 
            class="flex-shrink-0 w-12 h-12 rounded overflow-hidden bg-gray-700 relative group"
        >
            <img 
                v-if="track.image"
                :src="`/storage/track-images/${track.image}`"
                alt=""
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                <component
                    :is="isPlaying ? Pause : Play"
                    class="w-6 h-6 text-white"
                />
            </div>
        </button>
        <div class="flex-grow">
            <h3 class="font-medium text-white">{{ track.title }}</h3>
            <p class="text-sm text-gray-400">{{ track.artist }}</p>
            <div class="w-full h-1 bg-gray-700 rounded mt-2">
                <div 
                    class="h-full bg-blue-500 rounded transition-all duration-100" 
                    :style="{ width: `${progress}%` }"
                ></div>
            </div>
        </div>
        <div class="text-sm text-gray-400">
            Played {{ track.play_count }} times
        </div>
        <Link 
            :href="route('tracks.edit', track.uuid)"
            class="rounded-full p-3 hover:bg-gray-600 transition-colors"
        >
            <Pencil class="w-5 h-5 text-gray-400" />
        </Link>
        <button
            @click="deleteTrack(track.uuid)"
            class="rounded-full p-3 hover:bg-gray-600 transition-colors cursor-pointer"
        >
            <Trash class="w-5 h-5 text-gray-400" />
        </button>
    </li>
</template>
