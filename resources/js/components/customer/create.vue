<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add Customer</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Customer Insert
		      	<router-link to="/all-customer" class="btn btn-sm btn-info" id="add_new">All Customer</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="customerInsert" enctype="multipart/form-data">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="inputName" class="form-control" placeholder="Full Name" autofocus="autofocus" v-model="form.name">
	    		              <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	    		              <label for="inputName">Full Name</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="inputEmail" class="form-control" placeholder="Email" autofocus="autofocus" v-model="form.email">
	    		              <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
	    		              <label for="inputEmail">Email Address</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="address" class="form-control" placeholder="Address" autofocus="autofocus" v-model="form.address">
	    		              <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
	    		              <label for="address">Address</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="phone" class="form-control" placeholder="Phone Number" autofocus="autofocus" v-model="form.phone">
	    		              <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
	    		              <label for="phone">Phone Number</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="file" id="photo" class="btn btn-info" @change="onFileSelected">
	    		              <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<img :src="form.photo" style="height:40px;width:40px;">
		            	</div>
		            </div>
		          </div>
		          
		          <button type="submit" class="btn btn-success">Submit</button>
		        </form>
		       
		      </div>
		    </div>
		</div>
	</div>
</template>

<script type="text/javascript">
	// export default {
	// 	mounted()
	// 	{
	// 		if(!User.loggedIn())
	// 		{
	// 			this.$router.push({name: '/'})
	// 		}
	// 	},
	// 	data()
	// 	{
	// 		return {
	// 			form: {
	// 				name: '',
	// 				email: '',
	// 				phone: '',
	// 				salary: '',
	// 				address: '',
	// 				photo: '',
	// 				nid: '',
	// 				joiningDate: '',
	// 			},
	// 			errors: {},
	// 		}
	// 	},
	// 	methods:{
	// 		onFileSelected(event)
	// 		{
	// 			let file = event.target.files[0];
	// 			if(file.size > 1048770)
	// 			{
	// 				//console.log(event);
	// 				Notification.image_validation();
	// 			}
	// 			else
	// 			{
	// 				let reader = new FileReader();
	// 				reader.onload = event => {

	// 					this.form.photo = event.target.result;
	// 					console.log(event.target.result);

	// 				};
	// 				reader.readAsDataURL(file);
	// 			}
	// 		},
	// 		employeeInsert()
	// 		{
	// 			axios.post('api/employee',this.form)
	// 			.then(response => {
	// 				this.$router.push({name: 'all_employee'});
	// 				Notification.success();
	// 			})
	// 			.catch(error => {
	// 				this.errors = error.response.data.errors;
	// 			})
	// 		}
	// 	}
	// }
</script>
<script type="text/javascript">
	export default {
		mounted()
		{
			if(!User.loggedIn())
			{
				this.$router.push({name: '/'});
			}
		},
		data()
		{
			return {
				form: {
					name: '',
					email: '',
					phone: '',
					address: '',
					photo: '',
				},
				errors: {},
			}
		},
		methods: {
			onFileSelected(event)
			{
				let file = event.target.files[0];
				if(file.size > 1048770)
				{
					Notification.image_validation();
				}
				else
				{
					let reader = new FileReader();
					reader.onload = event => {
						this.form.photo = event.target.result;
						console.log(event.target.result);
					};
					reader.readAsDataURL(file);
				}
			},
			customerInsert()
			{
				axios.post('api/customer',this.form)
				.then(response => {
					this.$router.push({name: 'all_customer'});
					Notification.success();
				})
				.catch(error => {
					this.errors = error.response.data.errors;
				})
			}
		}
	}
</script>

<style type="text/css">

</style>