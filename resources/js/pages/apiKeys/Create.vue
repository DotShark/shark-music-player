<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import OutlinedButton from '@/components/OutlinedButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Key } from 'lucide-vue-next';

const form = useForm({
    name: '',
});

function submit() {
    form.post(route('api-keys.store'));
}
</script>

<template>

    <Head title="Create API Key" />

    <MusicLayout>
        <template #title>Create API Key</template>
        <template #action>
            <OutlinedLink :href="route('api-keys.index')">
                Back to API Keys
            </OutlinedLink>
        </template>
        <template #content>
            <div class="p-8">
                <div class="max-w-md mx-auto">
                    <div class="bg-white/5 rounded-lg p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <Key class="w-6 h-6 text-blue-400" />
                            <h2 class="text-xl font-semibold">New API Key</h2>
                        </div>

                        <div class="bg-blue-900/20 border border-blue-500/30 rounded-lg p-4 mb-6">
                            <p class="text-sm text-blue-200">
                                <strong>Important:</strong> The API key will be generated automatically and will only be
                                displayed once after creation. Make sure to copy and store it securely.
                            </p>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <TextInput id="name" label="API Key Name" placeholder="Ex: Mobile App, Discord Bot..."
                                v-model="form.name" :error="form.errors.name" required />

                            <div class="flex gap-3">
                                <OutlinedButton type="submit" :disabled="form.processing" class="flex-1">
                                    {{ form.processing ? 'Creating...' : 'Create API Key' }}
                                </OutlinedButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </MusicLayout>
</template>
