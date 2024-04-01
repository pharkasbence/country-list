<template>
    <div v-if="errorMessage" class="text-lg text-red-600 text-center p-4">
        {{ errorMessage }}
    </div>

    <div 
        v-else 
        ref="infiniteScrollContainer" 
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 h-[calc(100vh-75px)] overflow-y-scroll"
    >
        <div 
            v-for="country in countries" 
            :key="'country_ ' + country.name"
        >
            <country-list-item :name="country.name" :flag-url="country.flag" />
        </div>
    </div>

    <div v-if="isLoading" class="text-gray-400 text-lg text-center p-4 w-full">
        Loading...
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useInfiniteScroll } from '@vueuse/core';

    import CountryListItem from './components/CountryListItem.vue';

    import apiClient from '@services/api-client';

    const infiniteScrollContainer = ref(null);
    const countries = ref([]);
    const currentPage = ref(1);
    const isLoading = ref(false);
    const hasMoreData = ref(true);
    const errorMessage = ref('');

    const requiredFields = ['name', 'flag'];

    useInfiniteScroll(
        infiniteScrollContainer,
        () => {
            fetchCountries();
        },
        { distance: 1 }
    );

    async function fetchCountries() {
        if (!hasMoreData.value) {
            return false;
        }
        
        try {
            isLoading.value = true;

            const response = await apiClient.get('/countries', {
                params: { fields: requiredFields.join(','), page: currentPage.value }
            });
            
            const responseCountries = response.data.data;

            countries.value = [...countries.value, ...responseCountries];

            hasMoreData.value = responseCountries.length;

            currentPage.value++;
        } catch (error) {
            hasMoreData.value = false;

            errorMessage.value = error.message;
        } finally {
            isLoading.value = false;
        }
    }
</script>