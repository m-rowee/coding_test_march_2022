<script setup>
import { useUserStore } from "../stores/user";

const user = useUserStore();
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            You are logged in as <b>{{ user.username }}</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
