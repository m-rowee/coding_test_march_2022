<script setup>
import { ref, reactive } from "vue";
import axios from "axios";
import { useUserStore } from "../stores/user";

//attributes for form
const auth = reactive({ email: "", password: "" });
const processing = ref(false);

//get error from Laravel Validation
const validatedErrors = ref({});

//user store
const user = useUserStore();
async function login() {
    processing.value = true;
    await axios.get("/sanctum/csrf-cookie");
    await axios
        .post("/api/authenticate", auth)
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
                        <h1 class="text-center">Login</h1>
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
                        <hr />
                        <form
                            action="javascript:void(0)"
                            class="row"
                            method="post"
                        >
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold"
                                    >Email</label
                                >
                                <input
                                    type="text"
                                    v-model="auth.email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="font-weight-bold"
                                    >Password</label
                                >
                                <input
                                    type="password"
                                    v-model="auth.password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                />
                            </div>
                            <div class="col-12 m-2">
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    @click="login"
                                    class="btn btn-primary btn-block"
                                >
                                    {{ processing ? "Please wait" : "Login" }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label
                                    >Don't have an account?
                                    <a href="/registration"
                                        >Register Now!</a
                                    ></label
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
