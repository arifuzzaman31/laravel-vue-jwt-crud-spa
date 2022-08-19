<template>
    <div>
        <div class="container mt-3" v-if="!loading">
            <div class="card text-center">
                <div class="card-header d-flex justify-content-between">
                    <span></span>
                    <span><h3>Customer List</h3></span>
                    <span>
                        <button type="button" @click.prevent="openCustomerModal()" class="btn btn-primary">
                            Create New
                        </button>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customer in customers" :key="customer.id">
                                    <th scope="row">{{ customer.id }}</th>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <a @click.prevent="editCustomer(customer)" class="btn btn-primary" href="#"><i class="fa fa-edit" title="Edit"></i></a> 
                                        <a @click.prevent="deleteitem(customer.id)" class="btn btn-danger" href="#"><i class="fa fa-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div v-else>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- create Modal -->
            <div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerModalLabel">Create New Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="modalHide()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="save()">
                            <div class="row">
                                <div class="col-md-12" v-if="validation_error" style="margin-top: 5px">
                                    <div class="form-group">

                                        <div>
                                            <ul>
                                                <li class="text-danger" v-for="error in validation_error" :key="error[0]">{{ error[0] }}</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name *</label> 
                                        <input type="text" v-model="form.name"   class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>						
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label> 
                                        <input type="text" v-model="form.email"   class="form-control" placeholder="user@mail.com">
                                    </div>
                                </div>						
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone</label> 
                                        <input type="text" v-model="form.phone"   class="form-control" placeholder="012xxxxxx">
                                    </div>
                                </div>						
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label> 
                                        <textarea class="form-control" v-model="form.address" row="3" placeholder="write Address"></textarea>
                                    </div>
                                </div>						
                            
                                </div>	

                            <div class="row mt-5">								

                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">{{ button_name }}</button>
                                    <button type="close" class="btn btn-default" data-dismiss="modal" @click.prevent="modalHide()">Close</button>
                                </div>

                            </div>
                        </form>
                    </div>  
                </div>
            </div>
    </div>
    <update-customer />
    </div>
</template>

<script>
    import axios from 'axios';
      import { EventBus } from  '../vue-assets';
      import  UpdateCustomer from  './UpdateCustomer';
    export default {
        components:{
            UpdateCustomer
        },
        data(){
            return {
                customers: [],
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    address: ''
                },
                loading: true,
                button_name: 'Save',
                validation_error: {}
            }
        },

         mounted(){
            this.getCustomer()
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
            openCustomerModal(){
                $('#createCustomerModal').modal('show');
            },
            modalHide(){
                $('#createCustomerModal').modal('hide');
            },

            resetForm(){
                this.form = {
                    name: '',
                    email: '',
                    phone: '',
                    address: ''
                },
                this.validation_error = {};
            },

            getCustomer(){
                axios.get(base_url+'get-customer',this.form)
            	.then(response => {
                    this.customers = response.data
                });
            },

             save(){

            	this.button_name = "Saving...";


            	axios.post(base_url+'customer',this.form)
            	.then(response => {
          
            		if(response.data.status){

            			$('#createCustomerModal').modal('hide');
            			this.resetForm();
            			alert(response.data.message);
            			this.button_name = "Save";

					}
				   else
				   {
					  alert(response.data.message);	
					  this.button_name = "Save";
					}					


            	})
            	.catch(err => {
                    alert('Error Occured')
            		this.button_name = "Save";
            		
				})

            },

            editCustomer(customer)
            {
                EventBus.$emit('update-customer',customer);
            },

            deleteitem(id){
                let result = confirm('Are you sure you want to delete?');

                if(result){
                    axios.delete(base_url+'customer-destroy/'+id)
                        .then(response => {
                            if(response.data.status){

                                alert('Data Deleted')
                            }
                        })
                        .catch(err => {
                            alert('Error Occured')
                        })
                }
            },

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
