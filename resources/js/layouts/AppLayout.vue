<template>
    <div class="min-h-screen">
        <TheHeader />
        <main
            class="flex items-center justify-center h-[calc(100vh_-_7.5rem)] bg-background"
        >
            <JokePresentation />
        </main>
        <TheFooter />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import TheHeader from '@/components/TheHeader.vue';
import TheFooter from '@/components/TheFooter.vue';
import JokePresentation from '@/components/JokePresentation.vue';

export default defineComponent({
    name: 'AppLayout',
    components: { JokePresentation, TheFooter, TheHeader },
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
