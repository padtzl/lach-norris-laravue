<template>
    <div class="min-h-screen">
        <TheHeader />
        <main
            class="flex flex-col items-center h-[calc(100vh_-_7.5rem)] bg-background pt-4"
        >
            <JokePresentation />
            <Search />
        </main>
        <TheFooter />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import TheHeader from '@/components/TheHeader.vue';
import TheFooter from '@/components/TheFooter.vue';
import JokePresentation from '@/components/JokePresentation.vue';
import Search from '@/components/Search.vue';

export default defineComponent({
    name: 'AppLayout',
    components: { Search, JokePresentation, TheFooter, TheHeader },
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
