<template>
    <div class="flex justify-center mt-4 space-x-2">
        <button
            @click="previousPage"
            :disabled="!hasPreviousPage"
            class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        >
            Vorherige
        </button>

        <button
            @click="nextPage"
            :disabled="!hasNextPage"
            class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
        >
            Nächste
        </button>
    </div>
</template>

<script setup lang="ts">
import { useSearchStore } from '@/stores/searchStore';
import { storeToRefs } from 'pinia';

const store = useSearchStore();
const { nextPage, previousPage } = store;
const { hasPreviousPage, hasNextPage } = storeToRefs(store);
</script>
