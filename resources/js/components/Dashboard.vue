<script setup>
import axios from "axios";
import { onBeforeMount } from "vue-demi";
import { useUserStore } from "../stores/user";

const user = useUserStore();

onBeforeMount(() => {
    user.login();
});
async function logout() {
    await axios.post("/api/logout").then((response) => {
        if (response.data) {
            window.location.replace("/");
        }
    });
}
</script>

<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a href="#" class="navbar-brand ml-2">User Dashboard</a>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <router-link :to="{ name: 'Home' }" class="nav-link"
                            >Home
                            <span class="sr-only">(current)</span></router-link
                        >
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownMenuLink"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            {{ user.username }}
                        </a>

                        <ul
                            class="dropdown-menu dropdown-menu-end position-absolute end-0"
                            aria-labelledby="navbarDropdownMenuLink"
                        >
                            <li>
                                <router-link
                                    :to="{ name: 'ProfileInfo' }"
                                    class="dropdown-item"
                                    >Profile</router-link
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="javascript:void(0)"
                                    @click="logout"
                                    >Logout</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="mt-3">
            <router-view></router-view>
        </main>
    </div>
</template>
