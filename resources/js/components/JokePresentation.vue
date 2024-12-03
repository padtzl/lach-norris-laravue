<template>
    <BaseCard>
        <div class="text-xl mb-6 text-center text-white">
            <h1 class="mb-4 text-xl font-bold">Chuck Norris Witz</h1>
            <p>{{ joke }}</p>
        </div>
        <div class="mt-8 mb-6 text-center">
            <BaseButton
                type="button"
                size="md"
                variant="primary"
                @click="getNewJoke"
                :loading="isLoading"
            >
                {{ isLoading ? 'Laden...' : 'Weiteren Witz laden' }}
            </BaseButton>
        </div>
        <div class="absolute right-4 bottom-2" v-if="source">
            <span class="text-white">Quelle: {{ source }}</span>
        </div>
    </BaseCard>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';

const joke = ref<string>('');
const source = ref<string | null>(null);
const isLoading = ref(false);

const getNewJoke = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get('/joke');
        joke.value = response.data.joke;
        source.value = response.data.source;
    } catch (error) {
        joke.value = 'Failed to fetch a joke. Please try again.';
        console.error('Error fetching joke:', error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    getNewJoke();
});
</script>
