<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Update Salary</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Update Employee Salary
		      	<router-link to="/all-salary" class="btn btn-sm btn-info" id="add_new">Employee List</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="updateSalary" enctype="multipart/form-data">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="inputName" class="form-control" placeholder="Full Name" autofocus="autofocus" v-model="form.name" readonly>
	    		              <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
	    		              <label for="inputName">Full Name</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="salary" class="form-control" placeholder="Salary" autofocus="autofocus" v-model="form.salary" readonly>
	    		              <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
	    		              <label for="salary">Salary</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-group">
		            		  <label for="category">Salary Month</label>
	    		              <select class="form-control" id="category" v-model="form.salary_month">
	    		              	<option value="January">January</option>
	    		              	<option value="February">February</option>
	    		              	<option value="March">March</option>
	    		              	<option value="April">April</option>
	    		              	<option value="May">May</option>
	    		              	<option value="June">June</option>
	    		              	<option value="July">July</option>
	    		              	<option value="August">August</option>
	    		              	<option value="September">September</option>
	    		              	<option value="October">October</option>
	    		              	<option value="November">November</option>
	    		              	<option value="December">December</option>
	    		              </select>
	    		              <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-group">
		            		  <label for="salary">Pay Salary Amount</label>
	    		              <input type="text" id="salary" class="form-control" placeholder="Salary" autofocus="autofocus" v-model="form.salary_amount">
	    		              <small class="text-danger" v-if="errors.salary_amount">{{ errors.salary_amount[0] }}</small>
	    		            </div>
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
					salary: '',
					salary_amount: '',
					salary_month: '',
				},
				errors: {},
			}
		},
		methods:{
			updateSalary()
			{
				let id = this.$route.params.id;
				axios.post('/inventoryWithVueAndAPI/public/api/update-salary/'+id,this.form)
				.then(response => {
					console.log(response.data);
					this.$router.push({name: 'employee_list'});
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
			axios.get('/inventoryWithVueAndAPI/public/api/edit-salary/'+id)
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