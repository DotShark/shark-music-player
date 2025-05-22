<script setup lang="ts">
import { Track } from '@/types/Track';
import ToggleSwitch from './ToggleSwitch.vue';

defineProps<{
    track: Track;
    isInPlaylist: boolean;
}>();

const emit = defineEmits<{
    'toggle-in-playlist': [trackId: string]
}>();
</script>

<template>  
    <div 
        class="flex flex-row justify-between items-center gap-2 p-4 bg-gray-800 rounded-lg cursor-pointer"
        :class="{ 'ring-2 ring-blue-500': isInPlaylist }"
        @click="emit('toggle-in-playlist', track.uuid)">
        <div>
            <div class="font-semibold">{{ track.title }}</div>
            <div class="text-sm text-gray-400">{{ track.artist }}</div>
        </div>
        <ToggleSwitch :id="track.uuid" label="" :model-value="isInPlaylist" />
    </div>
</template>
