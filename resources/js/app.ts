import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import AppLayout from './layouts/AppLayout.vue';
import BaseCard from '@/components/BaseCard.vue';
import BaseButton from '@/components/BaseButton.vue';

const app = createApp(AppLayout);
const pinia = createPinia();
app.use(pinia);

app.component('BaseCard', BaseCard);
app.component('BaseButton', BaseButton);

app.mount('#app');
