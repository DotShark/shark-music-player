<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col h-screen">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <Link 
                            class="flex flex-shrink-0 items-center"
                            :href="route('home')"
                        >
                            <img class="h-8 w-auto"
                                src="https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg"
                                alt="Your Company"
                            />
                        </Link>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <Link
                                    class="rounded-md px-3 py-2 text-sm font-medium"
                                    :class="[route().current()?.includes('tracks') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                    :href="route('tracks.index')"
                                >
                                    Tracks
                                </Link>
                                <Link
                                    class="rounded-md px-3 py-2 text-sm font-medium"
                                    :class="[route().current()?.includes('playlists') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']"
                                    :href="route('playlists.index')"
                                >
                                    Playlists
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <div class="relative ml-3">
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="px-16 flex flex-col grow">
            <div class="flex justify-between items-center">
                <h4 class="text-3xl font-bold my-6">
                    <slot name="title" />
                </h4>
                <div>
                    <slot name="action" />
                </div>
            </div>
            <div class="flex flex-col grow">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
