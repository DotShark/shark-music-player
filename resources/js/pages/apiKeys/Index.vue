<script setup lang="ts">
import MusicLayout from '@/layouts/MusicLayout.vue';
import OutlinedLink from '@/components/OutlinedLink.vue';
import { Trash, Copy, Key } from 'lucide-vue-next';
import { Head, router, usePage } from '@inertiajs/vue3';
import type { ApiKey } from '@/types/ApiKey';
import { ref, onMounted } from 'vue';

type Props = {
    apiKeys: ApiKey[];
    newApiKey?: ApiKey | null;
};

defineProps<Props>();

const page = usePage();
const showNewKeyModal = ref(false);
const newApiKeyRef = ref<ApiKey | null>(null);

onMounted(() => {
    if (page.props.newApiKey) {
        newApiKeyRef.value = page.props.newApiKey as ApiKey;
        showNewKeyModal.value = true;
    }
});

function deleteApiKey(apiKeyUuid: string) {
    if (confirm('Are you sure you want to delete this API key? This action is irreversible.')) {
        router.delete(route('api-keys.destroy', apiKeyUuid));
    }
}

function copyToClipboard(text: string) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Key copied to clipboard!');
    });
}

function closeModal() {
    showNewKeyModal.value = false;
    newApiKeyRef.value = null;
}

function formatDate(date: string | Date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}
</script>

<template>    <Head title="API Keys" />

    <MusicLayout>
        <template #title>API Keys</template>
        <template #action>
            <OutlinedLink :href="route('api-keys.create')">Create API Key</OutlinedLink>
        </template>
        <template #content>
            <div class="flex flex-col p-8 gap-4">
                <div v-if="apiKeys.length === 0" class="text-center text-gray-500">
                    <Key class="w-16 h-16 mx-auto mb-4 opacity-50" />
                    <p class="text-lg mb-2">No API Keys</p>
                    <p class="text-sm">Create your first API key to securely access the API.</p>
                </div>
                <div v-else class="grid gap-4">
                    <div v-for="apiKey in apiKeys" :key="apiKey.uuid" 
                         class="bg-white/5 rounded-lg p-6 hover:bg-white/10 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-2 flex items-center gap-2">
                                    <Key class="w-5 h-5" />
                                    {{ apiKey.name }}
                                </h3>
                                <p class="text-sm text-gray-400 mb-2">
                                    ID: {{ apiKey.uuid }}
                                </p>                                <p class="text-xs text-gray-500">
                                    Created on {{ formatDate(apiKey.created_at) }}
                                </p>
                            </div>
                            <button
                                @click="deleteApiKey(apiKey.uuid)"
                                class="rounded-full p-3 hover:bg-red-600/20 transition-colors cursor-pointer group"
                                title="Delete API key"
                            >
                                <Trash class="w-5 h-5 text-red-400 group-hover:text-red-300" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>            <!-- Modal to display the new API key -->
            <div v-if="showNewKeyModal && newApiKeyRef" 
                 class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
                 @click="closeModal">
                <div class="bg-gray-800 p-6 rounded-lg max-w-md w-full mx-4" @click.stop>
                    <h3 class="text-lg font-semibold mb-4 text-green-400">
                        ✅ API Key created successfully!
                    </h3>
                    <p class="text-sm text-gray-300 mb-4">
                        Here is your new API key. <strong>Copy it now</strong> as it will never be displayed again for security reasons.
                    </p>
                    
                    <div class="bg-gray-900 p-4 rounded border mb-4">
                        <p class="text-xs text-gray-400 mb-2">Name:</p>
                        <p class="font-mono text-sm mb-3">{{ newApiKeyRef.name }}</p>
                        
                        <p class="text-xs text-gray-400 mb-2">API Key:</p>
                        <div class="flex items-center gap-2">
                            <code class="bg-gray-700 px-3 py-2 rounded text-sm font-mono flex-1 break-all">
                                {{ newApiKeyRef.key }}
                            </code>
                            <button 
                                @click="copyToClipboard(newApiKeyRef.key!)"
                                class="p-2 hover:bg-gray-600 rounded transition-colors"
                                title="Copy key"
                            >
                                <Copy class="w-4 h-4" />
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button 
                            @click="closeModal"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded transition-colors"
                        >
                            I've copied the key
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </MusicLayout>
</template>
