<template>
    <BaseCard>
        <div class="text-xl mb-6 text-center text-white">
            {{ joke }}
        </div>
        <div class="mt-8 text-center">
            <BaseButton
                type="button"
                size="md"
                variant="primary"
                @click="getNewJoke"
                :loading="isLoading"
            >
                {{ isLoading ? 'Loading...' : 'Get Another Joke' }}
            </BaseButton>
        </div>
    </BaseCard>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';

const joke = ref('');
const isLoading = ref(false);

const getNewJoke = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get('/joke');
        joke.value = response.data.joke;
        console.log(joke.value);
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
