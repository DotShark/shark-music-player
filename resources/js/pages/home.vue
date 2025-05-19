<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />

    <MusicLayout>
        <template #title>Home</template>
        <template #action>Action</template>
        <template #content>Hello</template>
    </MusicLayout>
</template>
