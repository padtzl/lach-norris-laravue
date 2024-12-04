<template>
    <span class="text-white" v-html="highlightSearchTerm(joke)"></span>
</template>

<script setup lang="ts">
import { useSearchStore } from '@/stores/searchStore';

interface ListItemProps {
    joke: string;
}
defineProps<ListItemProps>();

const store = useSearchStore();

const highlightSearchTerm = (content: string): string => {
    if (!store.searchTerm) return content;
    const regex = new RegExp(`(${store.searchTerm})`, 'gi');
    return content.replace(regex, '<mark>$1</mark>');
};
</script>
