<template>
    <button
        :type="type"
        :disabled="disabled || loading"
        class=" inline-flex items-center justify-center font-medium rounded-md shadow-sm text-white transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
        :class="buttonClasses"
        @click="(event: MouseEvent) => emit('click', event)"
    >
        <slot />
    </button>
</template>

<script setup lang="ts">
import {computed} from "vue";

type ButtonType = 'button' | 'submit';
type ButtonVariant = 'primary' | 'success' | 'danger';
type ButtonSize = 'sm' | 'md' | 'lg';

interface Props {
    type?: ButtonType;
    variant?: ButtonVariant;
    size?: ButtonSize;
    disabled?: boolean;
    loading?: boolean;
}

const props = defineProps<Props>();
const emit = defineEmits<{
    (e: 'click', event: MouseEvent): void;
}>();

const buttonClasses = computed(() => {
    return [
        props.variant ? `btn-${props.variant}` : '',
        props.size ? `btn-${props.size}` : '',
    ];
});
</script>

<style scoped>
@tailwind base;
@layer base {
    .btn-primary {
        @apply bg-primary hover:bg-primary-dark;
    }

    .btn-success {
        @apply bg-green-600 hover:bg-green-700;
    }

    .btn-danger {

        @apply bg-red-600 hover:bg-red-700 focus:ring-red-500;
    }

    .btn-sm {
        @apply px-2 py-1 text-sm;
    }

    .btn-md {
        @apply px-4 py-2 text-base;
    }

    .btn-lg {
        @apply px-6 py-3 text-lg;
    }
}
</style>
