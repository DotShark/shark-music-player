<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import { Link } from '@inertiajs/vue3';
import { Trash } from 'lucide-vue-next';
import { Head, router } from '@inertiajs/vue3';
import type { Playlist } from '@/types/Playlist';

type Props = {
    playlists: Playlist[];
};

defineProps<Props>();

function deletePlaylist(playlistId: string) {
    if (confirm('Are you sure you want to delete this playlist?')) {
        router.delete(route('playlists.destroy', playlistId));
    }
};

</script>

<template>
    <Head title="Playlists" />

    <MusicLayout>
        <template #title>Playlists</template>
        <template #action>
            <OutlinedLink :href="route('playlists.create')">Create a playlist</OutlinedLink>
        </template>
        <template #content>
            <div class="flex flex-col p-8 gap-4">
                <div v-if="playlists.length === 0" class="text-center text-gray-500">
                    No playlists yet.
                </div>
                <ul v-else class="flex flex-col gap-4">
                    <li v-for="playlist in playlists" :key="playlist.uuid" 
                        class="bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                        <Link :href="route('playlists.show', playlist.uuid)" class="flex items-center justify-between gap-4 p-4">
                            <h3 class="text-lg font-semibold">
                                {{ playlist.title }}
                            </h3>
                            <button
                                @click.stop.prevent="deletePlaylist(playlist.uuid)"
                                class="rounded-full p-3 hover:bg-gray-600 transition-colors cursor-pointer"
                            >
                                <Trash class="w-5 h-5 text-gray-400" />
                            </button>
                        </Link>
                    </li>
                </ul>
            </div>
        </template>
    </MusicLayout>
</template>
