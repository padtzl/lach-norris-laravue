<template>
    <div class="mb-4">
        <strong class="text-primary">Datenbank durchsuchen</strong>
        <form class="space-y-4 mt-4">
            <div class="flex w-xl gap-4">
                <input
                    v-model="store.searchTerm"
                    @input="debouncedHandleSearch"
                    type="text"
                    placeholder="Suchephrase eingeben"
                    class="flex-1 p-2 border rounded"
                />
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useSearchStore } from '@/stores/searchStore';

const store = useSearchStore();

const debounceTimeout = ref<number | null>(null);
const debouncedHandleSearch = () => {
    if (debounceTimeout.value) clearTimeout(debounceTimeout.value);
    debounceTimeout.value = window.setTimeout(() => {
        store.fetchJokes(store.searchTerm, 1);
    }, 300);
};
</script>
