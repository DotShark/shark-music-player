<script lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    name: 'Index',

    components: {
        // eslint-disable-next-line vue/no-reserved-component-names
        Head,
        MusicLayout
    }
};
</script>

<template>
    <Head title="Tracks" />

    <MusicLayout>
        <template #title>Tracks</template>
        <template #action>Action</template>
        <template #content>Hello</template>
    </MusicLayout>
</template>
