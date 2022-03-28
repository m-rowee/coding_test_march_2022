// import axios from "axios";
import { defineStore } from "pinia";
import axios from "axios";

export const useUserStore = defineStore({
    id: 'user',
    state: () => ({
       username: "",
       email: "",
       phone_number: "",
    }),
    actions: {
        async login() {
            const userData = await axios.get('/api/user');
            this.$patch({
                username: userData.data.username,
                email: userData.data.email,
                phone_number: userData.data.phone_number,
            })
        
        },
    
    }
}) 