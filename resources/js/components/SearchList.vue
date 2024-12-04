<template>
    <div v-if="hasJokes" class="space-y-2 bg-neutral">
        <SearchResultCount />
        <div
            v-for="item in jokes"
            :key="item.joke_id"
            class="p-4 border rounded bg-neutral-darker"
        >
            <SearchListItem :joke="item.value" />
        </div>
        <Pagination v-if="store.needsPagination" />
    </div>
    <div v-else-if="!isSearching && searchTerm">
        <span> Keine Ergebnisse für "{{ searchTerm }}"</span>
    </div>
</template>

<script setup lang="ts">
import SearchListItem from '@/components/SearchListItem.vue';
import Pagination from '@/components/Pagination.vue';
import SearchResultCount from '@/components/SearchResultCount.vue';
import { useSearchStore } from '@/stores/searchStore';
import { storeToRefs } from 'pinia';

const store = useSearchStore();

const { hasJokes, jokes, searchTerm, isSearching } = storeToRefs(store);
</script>
