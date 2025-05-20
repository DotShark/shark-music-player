<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/components/PrimaryButton.vue';
</script>

<template>
    <Head title="Home" />

    <MusicLayout class="h-screen">
        <template #title>Home</template>
        <template #content>
            <div class="flex flex-col items-center justify-center h-full">
                <h1 class="text-5xl font-bold text-white">Welcome to Music App</h1>
                <p class="mt-4 text-lg text-gray-400">Discover your favorite tracks and artists.</p>
                <PrimaryButton :href="route('tracks.index')" class="mt-6">
                    Explore Tracks
                </PrimaryButton>
            </div>
        </template>
    </MusicLayout>
</template>
