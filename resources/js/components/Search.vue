<template>
    <BaseCard class="mt-6">
        <div class="mb-4">
            <strong class="text-primary">Datenbank durchsuchen</strong>
            <form class="space-y-4 mt-4">
                <div class="flex w-xl gap-4">
                    <input
                        v-model="searchTerm"
                        @input="debouncedHandleSearch"
                        type="text"
                        placeholder="Suchephrase eingeben"
                        class="flex-1 p-2 border rounded"
                    />
                </div>
            </form>
        </div>

        <div
            v-if="jokes"
            :key="debouncedHandleSearch"
            class="space-y-2 bg-neutral"
        >
            <div v-if="total > 0" class="mb-4">
                <span class="text-sm text-white">{{
                    `${total} Ergebnisse`
                }}</span>
            </div>
            <div
                v-for="joke in jokes"
                :key="joke.joke_id"
                class="p-4 border rounded bg-neutral-darker"
            >
                <span
                    class="text-white"
                    v-html="highlightSearchTerm(joke.value)"
                ></span>
            </div>
        </div>
        <div v-if="jokes?.length" class="flex justify-center mt-4 space-x-2">
            <button
                @click="fetchPage(currentPage - 1)"
                :disabled="currentPage === 1 || isSearching"
                class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
            >
                Vorherige
            </button>

            <button
                @click="fetchPage(currentPage + 1)"
                :disabled="currentPage === lastPage || isSearching"
                class="px-4 py-2 bg-gray-200 rounded disabled:opacity-50"
            >
                Nächste
            </button>
        </div>

        <div
            v-else-if="!isSearching && searchTerm"
            class="text-center text-gray-300"
        >
            Keine Ergebnisse für "{{ searchTerm }}"
        </div>

        <div v-if="isSearching" class="text-center text-gray-300">
            Searching...
        </div>
    </BaseCard>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import axios from 'axios';

const searchTerm = ref('');
const isSearching = ref(false);
const jokes = ref([]);
const total = ref(0);
const currentPage = ref(1);
const lastPage = ref(1);
const perPage = ref(6);

let debounceTimeout: number | null = null;

// Debounce function
const debounce = (fn, delay) => {
    return (...args) => {
        if (debounceTimeout) {
            clearTimeout(debounceTimeout);
        }
        debounceTimeout = setTimeout(() => {
            fn(...args);
        }, delay);
    };
};

const handleSearch = async () => {
    if (!searchTerm.value.trim()) {
        jokes.value = [];
        return;
    }

    isSearching.value = true;
    try {
        const response = await axios.get('/search', {
            params: {
                q: searchTerm.value,
                page: currentPage.value,
                per_page: perPage.value,
            },
        });
        jokes.value = response.data.data;
        currentPage.value = response.data.current_page;
        lastPage.value = response.data.last_page;
        total.value = response.data.total;
    } catch (error) {
        console.error('Error fetching settings:', error);
    } finally {
        isSearching.value = false;
    }
};

const debouncedHandleSearch = debounce(handleSearch, 300);

const fetchPage = async (page: number) => {
    if (page < 1 || page > lastPage.value) return;
    currentPage.value = page;
    await handleSearch();
};

watch(searchTerm, () => {
    currentPage.value = 1;
    total.value = 0;
});

const highlightSearchTerm = (content: string): string => {
    if (!searchTerm.value) return content;
    const regex = new RegExp(`(${searchTerm.value})`, 'gi');
    return content.replace(regex, '<mark>$1</mark>');
};
</script>
