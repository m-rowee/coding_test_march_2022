
import { createRouter, createWebHistory } from 'vue-router';
//Guest
const Login = () => import('../components/Login.vue');
const Register = () => import("../components/Register.vue");


// Authenticated
const Dashboard = () => import("../components/Dashboard.vue");
const Home = () => import("../components/Home.vue");
const ProfileInfo = () => import("../components/ProfileInfo.vue");


const routes = [
    {path: '/', name: 'Home', component: Home },
    {path: "/Login", name: "Login", component: Login},
    {path: '/registration', name: 'Register', component: Register},
    {path: '/info', name: 'ProfileInfo', component: ProfileInfo},
]

const router = createRouter({
     history: createWebHistory(),
     routes,
    
})

export default router;