<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Employee Salary Details</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Employee Salary Details
		      	<router-link to="/employee-list" class="btn btn-sm btn-info" id="add_new">Employee List</router-link>
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Name</th>
	                    <th>Photo</th>
	                    <th>Month</th>
	                    <th>Amount</th>
	                    <th>Date</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Name</th>
	                    <th>Photo</th>
	                    <th>Month</th>
	                    <th>Amount</th>
	                    <th>Date</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="monthlySalary in monthlySalaries" :key="">
	                    <td>{{ monthlySalary.name }}</td>
	                    <td><img :src="monthlySalary.photo" id="employee_photo"></td>
	                    <td>{{ monthlySalary.salary_month }}</td>
	                    <td>{{ monthlySalary.salary_amount }}</td>
	                    <td>{{ monthlySalary.salary_date }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'edit_salary', params:{id: monthlySalary.id} }" class="btn btn-sm btn-info">Edit Salary</router-link>
	                    </td>
	                  </tr>
	                </tbody>
	              </table>
	            </div>
		       
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
				this.$router.push({name: '/'});
			}
			this.monthlySalary();
		},
		data()
		{
			return {
				monthlySalaries:[],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.monthlySalaries.filter(monthlySalary => {
					return monthlySalary.name.match(this.searchTerm);
				});
			}
		},
		methods: {
			monthlySalary()
			{
				let month = this.$route.params.month;
				axios.get('/inventoryWithVueAndAPI/public/api/monthly-salary/'+month)
				.then(response => {
					this.monthlySalaries = response.data;
					console.log(response.data);
				})
				.catch(error => {
					console.log(error)
				})
			}
		}
		
	}
</script>

<style type="text/css">
	#add_new {
		float: right;
	}
	#employee_photo {
		width: 60px;
		height: 60px;
	}
</style>