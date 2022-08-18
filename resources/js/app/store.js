import Vuex from 'vuex';
import Vue from "vue";

Vue.use(Vuex);

export const stores = new Vuex.Store({
    state: {
        token: localStorage.getItem('auth') || '' ,
    },

    mutations: {
        setToken(state,token){
            console.log(token)
            localStorage.setItem('auth',token);
            state.token = token;
        },
        clearToken(state){
            localStorage.removeItem('auth');
            state.token = '';
        }
    }
});

// export default store;
