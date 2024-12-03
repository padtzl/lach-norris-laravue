<template>
    <div class="absolute right-3">
        <BaseButton
            @click="toggleApi"
            size="sm"
            :variant="apiEnabled ? 'success' : 'danger'"
            :loading="isLoading"
        >
            API Status: {{ apiEnabled ? 'Aktiv' : 'Inaktiv' }}
        </BaseButton>
    </div>
</template>
<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';

const apiEnabled = ref(false);
const isLoading = ref(false);
const toggleApi = async () => {
    isLoading.value = true;
    try {
        const response = await axios.post('/api-settings', {});
        apiEnabled.value = response.data.api_enabled;
    } catch (error) {
        console.error('Error fetching settings:', error);
    } finally {
        isLoading.value = false;
    }
};

const fetchApiSetting = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get('/api-settings');
        apiEnabled.value = response.data.api_enabled;
    } catch (error) {
        console.error('Error fetching settings:', error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchApiSetting();
});
</script>
