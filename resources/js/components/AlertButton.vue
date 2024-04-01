<template>
    <button 
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
        @click="onClick"
    >
        {{ text }}
    </button>
</template>

<script setup>
    const emit = defineEmits(['click']);

    const props = defineProps({
        text: { type: String, required: true },
    });

    function onClick() {
        emit('click');
    }
</script>