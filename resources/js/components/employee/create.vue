<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add Employee</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Employee Insert
		      	<router-link to="/all-employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="employeeInsert" enctype="multipart/form-data">
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
	    		              <input type="date" id="joiningDate" class="form-control" placeholder="Joining Date" autofocus="autofocus" v-model="form.joiningDate">
	    		              <small class="text-danger" v-if="errors.joiningDate">{{ errors.joiningDate[0] }}</small>
	    		              <label for="joiningDate">Joining Date</label>
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
					nid: '',
					joiningDate: '',
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

						this.form.photo = event.target.result;
						console.log(event.target.result);

					};
					reader.readAsDataURL(file);
				}
			},
			employeeInsert()
			{
				axios.post('api/employee',this.form)
				.then(response => {
					this.$router.push({name: 'all_employee'});
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