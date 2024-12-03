<template>
    <div class="min-h-screen">
        <TheHeader />
        <main
            class="flex items-center justify-center h-[calc(100vh_-_7.5rem)] bg-background"
        >
            <slot />
        </main>
        <TheFooter />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import TheHeader from '@/components/TheHeader.vue';
import TheFooter from '@/components/TheFooter.vue';

export default defineComponent({
    name: 'AppLayout',
    components: { TheFooter, TheHeader },
});
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
