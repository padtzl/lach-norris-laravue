<template>
    <div class="mb-4">
        <span class="text-sm text-white">{{
            `${store.total} Ergebnisse`
        }}</span>
    </div>
</template>

<script setup lang="ts">
import { useSearchStore } from '@/stores/searchStore';

const store = useSearchStore();
</script>
