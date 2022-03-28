<script setup>
import { useUserStore } from "../stores/user";
import { ref, reactive } from "vue";
import axios from "axios";
//user store
const user = useUserStore();

//toggle view or edit
const isView = ref(true);

//attributes for form
const processing = ref(false);
const isSuccess = ref(false);

//get error from Laravel Validation
const validatedErrors = ref({});

async function edit() {
    processing.value = true;
    await axios
        .put("/api/update", {
            username: user.username,
            email: user.email,
            phone_number: user.phone_number,
        })
        .then((response) => {
            if (response.data) {
                isView.value = true;
            }
        })
        .catch((error) => {
            let errors = Object.values(error.response.data.errors);
            errors = errors.flat();
            validatedErrors.value = errors;
        })
        .finally(() => (processing.value = false));
}
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Profile Info</h3>
                    </div>
                    <div class="card-body" v-if="isView">
                        <p class="mb-0"><b>Name: </b>{{ user.username }}</p>
                        <p class="mb-0"><b>Email: </b>{{ user.email }}</p>
                        <p class="mb-0">
                            <b>Phone Number: </b>{{ user.phone_number }}
                        </p>

                        <button
                            class="btn btn-success btn-block mt-2"
                            @click="isView = false"
                        >
                            Edit
                        </button>
                    </div>
                    <div class="card-body" v-else>
                        <div v-if="Object.keys(validatedErrors).length">
                            <ul class="alert alert-danger">
                                <li
                                    v-for="(value, index) in validatedErrors"
                                    :key="index"
                                >
                                    {{ value }}
                                </li>
                            </ul>
                        </div>
                        <div v-if="isSuccess">
                            <ul class="alert alert-danger">
                                <li>Profile updated successfully</li>
                            </ul>
                        </div>
                        <form
                            action="javascript:void(0)"
                            @submit="edit"
                            class="row"
                        >
                            <div class="form-group col-12">
                                <label for="username" class="font-weight-bold"
                                    >Username</label
                                >
                                <input
                                    type="text"
                                    name="username"
                                    v-model="user.username"
                                    id="name"
                                    placeholder="Edit username"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold"
                                    >Email</label
                                >
                                <input
                                    type="email"
                                    name="email"
                                    v-model="user.email"
                                    id="email"
                                    placeholder="Edit Email"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label
                                    for="phone_number"
                                    class="font-weight-bold"
                                    >Phone Number</label
                                >
                                <input
                                    type="tel"
                                    name="phone_number"
                                    v-model="user.phone_number"
                                    id="phone_number"
                                    placeholder="Edit Phone Number"
                                    class="form-control"
                                />
                            </div>
                            <div class="col-12 m-2">
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="btn btn-primary btn-block"
                                >
                                    {{ processing ? "Please wait" : "Edit" }}
                                </button>
                                <button
                                    class="btn btn-secondary btn-block ml-2"
                                    @click="isView = true"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
