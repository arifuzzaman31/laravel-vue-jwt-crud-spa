<template>
    <div>
        <div class="container" v-if="!loading">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                            </table>

                            <table class="table">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
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
                loading: true
            }
        },

         mounted(){
            if(this.$store.state.token !== '')
            {
                axios.post(base_url+'api/auth/checkToken',{token : this.$store.state.token})
                    .then(res => {
                        this.loading = false
                    })
                    .catch(err => {
                        this.loading = false
                        // this.$store.commit('clearToken')
                        // this.$router.push('/login');
                    })
            } else {
                this.loading = false
            }
        },

        methods: {
            logout(){
                axios.post(base_url+'api/auth/logout',{token : this.$store.state.token})
                    .then(res => {
                        this.loading = false
                        this.$store.commit('clearToken')
                        this.$router.push('/login');
                    })
                    .catch(err => {
                        this.loading = false
                    })
            }
        }
    }
</script>
