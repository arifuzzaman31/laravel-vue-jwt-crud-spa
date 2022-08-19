<template>
	 <!-- Edit Modal -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editcustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcustomerModalLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="modalHide()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="update()">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name *</label> 
                                <input type="text" v-model="form.name" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>						
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label> 
                                <input type="text" v-model="form.email" class="form-control" placeholder="user@mail.com">
                            </div>
                        </div>						
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone</label> 
                                <input type="text" v-model="form.phone" class="form-control" placeholder="012xxxxxx">
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
</template>

<script>
	
	import {EventBus} from  '../vue-assets';

	export default {

		data(){

			return {
                form: {
                    id: '',
                    name: '',
                    email: '',
                    phone: '',
                    address: ''
                },
                button_name: 'Update'
			}

		},

		mounted()
		{
          
          var _this = this;

          EventBus.$on('update-customer',function(customer) {
            _this.form = customer
           $('#editCustomerModal').modal('show');

          });

		},


		methods : {

			update(){
                this.button_name = "Saving...";


            	axios.post(base_url+'customer-update',this.form)
            	.then(response => {
          
            		if(response.data.status){

            			$('#editCustomerModal').modal('hide');
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
				})
            },
            resetForm(){
                this.form = {
                    name: '',
                    email: '',
                    phone: '',
                    address: ''
                }
            },
             openCustomerModal(){
                $('#editCustomerModal').modal('show');
            },
            modalHide(){
                $('#editCustomerModal').modal('hide');
            },


        },

    }

</script>
