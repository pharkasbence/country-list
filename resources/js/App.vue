<template>
    <div>
        <div class="p-4 text-right">
            <div v-if="isAuthenticated">
                <span>{{ user.name }}</span>
                <span class="ml-6"><button @click="logOut">Log out</button>   </span>
            </div>

            <div v-else>
                <button @click="login">Log in</button>
            </div>
        </div>

        <div v-if="isAuthenticated">
            <country-list-page />
        </div>
    </div>
</template>

<script setup>
    import { useAuth0 } from '@auth0/auth0-vue';

    import CountryListPage from '@pages/CountryListPage.vue';

    const { loginWithRedirect, logout, user, isAuthenticated } = useAuth0();

    function login() {
        loginWithRedirect();
    }

    function logOut() {
        logout({ logoutParams: { returnTo: window.location.origin } });
    }
</script>