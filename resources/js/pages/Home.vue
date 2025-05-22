<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Head } from '@inertiajs/vue3';
import OutlinedLink from '@/components/OutlinedLink.vue';
</script>

<template>
    <Head title="Home" />

    <MusicLayout class="h-screen">
        <template #title>Home</template>
        <template #content>
            <div class="flex flex-col items-center justify-center h-full">
                <h1 class="text-5xl font-bold text-white">Welcome to DotShark Music</h1>
                <p class="mt-4 text-lg text-gray-400">Discover your favorite tracks and artists.</p>
                <OutlinedLink :href="route('tracks.index')" class="mt-6">
                    Explore Tracks
                </OutlinedLink>
            </div>
        </template>
    </MusicLayout>
</template>
