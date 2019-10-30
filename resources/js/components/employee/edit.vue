<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Update Employee</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Employee Update
		      	<router-link to="/all-employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">
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
	    		              <input type="text" id="salary" class="form-control" placeholder="Salary" autofocus="autofocus" v-model="form.salary">
	    		              <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
	    		              <label for="salary">Salary</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-4">
		            		<div class="form-label-group">
	    		              <input type="date" id="joining_date" class="form-control" placeholder="Joining Date" autofocus="autofocus" v-model="form.joining_date">
	    		              <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
	    		              <label for="joining_date">Joining Date</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-4">
		            		<div class="form-label-group">
	    		              <input type="text" id="nid" class="form-control" placeholder="NID Number" autofocus="autofocus" v-model="form.nid">
	    		              <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
	    		              <label for="nid">NID Number</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-4">
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
		            	<div class="col-md-3">
		            		<img :src="form.new_photo" style="height:40px;width:40px;">
		            	</div>
		            	<div class="col-md-3">
		            		<label>Old Photo</label>
		            		<img :src="form.photo" style="height:40px;width:40px;">
		            	</div>
		            </div>
		          </div>
		          
		          <button type="submit" class="btn btn-success">Update</button>
		        </form>
		       
		      </div>
		    </div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		mounted()
		{
			if(!User.loggedIn())
			{
				this.$router.push({name: '/'})
			}
		},
		data()
		{
			return {
				form: {
					name: '',
					email: '',
					phone: '',
					salary: '',
					address: '',
					photo: '',
					new_photo: '',
					nid: '',
					joining_date: '',
				},
				errors: {},
			}
		},
		methods:{
			onFileSelected(event)
			{
				let file = event.target.files[0];
				if(file.size > 1048770)
				{
					//console.log(event);
					Notification.image_validation();
				}
				else
				{
					let reader = new FileReader();
					reader.onload = event => {

						this.form.new_photo = event.target.result;
						console.log(event.target.result);

					};
					reader.readAsDataURL(file);
				}
			},
			employeeUpdate()
			{
				let id = this.$route.params.id;
				axios.patch('/inventoryWithVueAndAPI/public/api/employee/'+id,this.form)
				.then(response => {
					this.$router.push({name: 'all_employee'});
					Notification.success();
				})
				.catch(error => {
					this.errors = error.response.data.errors;
				})
			}
		},
		created()
		{
			let id = this.$route.params.id;
			axios.get('/inventoryWithVueAndAPI/public/api/employee/'+id)
			.then(response => {
				this.form = response.data;
				console.log(response.data);
			})
			.catch(error => {
				console.log(error);
			})
		}
	}
</script>

<style type="text/css">

</style>