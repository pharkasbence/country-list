<template>
    <div class="h-screen overscroll-none overflow-hidden">
        <div class="p-4 text-right bg-gray-200 fixed w-full">
            <div v-if="isAuthenticated">
                <span>{{ user.name }}</span>

                <span class="ml-6">
                    <alert-button text="Log out" @click="onLogoutButtonClicked" />
                </span>
            </div>

            <div v-else>
                <success-button text="Log in" @click="onLoginButtonClicked" />
            </div>
        </div>

        <div v-if="isAuthenticated" class="pt-20">
            <country-list-page />
        </div>
    </div>
</template>

<script setup>
    import { useAuth0 } from '@auth0/auth0-vue';

    import SuccessButton from '@components/SuccessButton.vue';
    import AlertButton from '@components/AlertButton.vue';
    import CountryListPage from '@pages/CountryListPage.vue';

    const { loginWithRedirect, logout, user, isAuthenticated } = useAuth0();

    function onLoginButtonClicked() {
        loginWithRedirect();
    }

    function onLogoutButtonClicked() {
        logout({ logoutParams: { returnTo: window.location.origin } });
    }
</script>