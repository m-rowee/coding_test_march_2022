<script setup>
import { ref, reactive, computed } from "vue";
import axios from "axios";

//attributes for form
const user = reactive({
    username: "",
    email: "",
    phone_number: "",
    password: "",
    password_confirmation: "",
});
const processing = ref(false);

//get error from Laravel Validation
const validatedErrors = ref({});

//Register Function
async function register() {
    processing.value = true;
    await axios
        .post("/api/register", user)
        .then((response) => {
            if (response.data) {
                window.location.replace("/");
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
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Register</h1>
                        <hr />
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
                        <form
                            action="javascript:void(0)"
                            @submit="register"
                            class="row"
                            method="post"
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
                                    placeholder="Enter username"
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
                                    placeholder="Enter Email"
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
                                    placeholder="Enter Phone Number"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="font-weight-bold"
                                    >Password</label
                                >
                                <input
                                    type="password"
                                    name="password"
                                    v-model="user.password"
                                    id="password"
                                    placeholder="Enter Password"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label
                                    for="password_confirmation"
                                    class="font-weight-bold"
                                    >Confirm Password</label
                                >
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    v-model="user.password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Enter Password"
                                    class="form-control"
                                />
                            </div>
                            <div class="col-12 m-2">
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="btn btn-primary btn-block"
                                >
                                    {{
                                        processing ? "Please wait" : "Register"
                                    }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label
                                    >Already have an account?
                                    <a href="/login">Login Now!</a></label
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
