<template>
    <div class="border-2 border-gray-400 h-full p-4">
        <div>
            <img :src="flagUrl">
        </div>

        <div class="text-center mt-2 font-bold">{{ name }}</div>
    </div>
</template>

<script setup>
    const props = defineProps({
        name: { type: String, default: '' },
        flagUrl: { type: String, default: '' },
    });
</script>