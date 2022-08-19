<template>
    <div>
    <div class="login" v-if="!loading">
        <form class="form">
            <div class="form-group mt-3">
                <input class="form-control" placeholder="Email" type="text" v-model="credentials.email" />
            </div>
            <div class="form-group mt-2">
                <input class="form-control" placeholder="Password" type="password" v-model="credentials.password"/>
            </div>
            <button class="btn btn-primary mt-2" @click.prevent="login()">Login</button>
        </form>
    </div>

    <div v-else>
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return {
                credentials: {
                    email: '',
                    password: ''
                },

                loading: true
            }
        },

        mounted(){
            if(this.$store.state.token !== '')
            {
                axios.post(base_url+'api/auth/checkToken',{token : this.$store.state.token})
                    .then(res => {
                        this.loading = false
                        if(res.data.success){
                            this.$router.push('/dashboard')
                        } else {
                            this.$store.commit('setToken',res.data._token)
                        }
                    })
                    .catch(err => {
                        this.loading = false
                        this.$store.commit('clearToken')
                    })
            } else {
                this.loading = false
            }
        },

        methods: {
            login(){
                axios.post(base_url+'api/auth/login', this.credentials)
                    .then(response => {
                        if(response.data.success)
                        {
                            // console.log(response.data._token)
                            this.$store.commit('setToken',response.data._token)
                            this.$router.push('/dashboard')
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>
<style scoped>
    .login {
        background-color: #FFF;
        border: 1px solid #EEE;
        padding: 10px;
        margin: 50px auto;
        width: 500px;
    }
    button {
        display: block;
        margin: 0 auto;
    }
</style>
