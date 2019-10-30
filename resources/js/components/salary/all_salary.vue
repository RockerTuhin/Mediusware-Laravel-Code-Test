<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">All Salary</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	All Salary
		      	<router-link to="/employee-list" class="btn btn-sm btn-info" id="add_new">Employee List</router-link>
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Month</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Month</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="salary in filterSearch" :key="salary.salary_month">
	                    <td>{{ salary.salary_month }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'view_salary', params:{month: salary.salary_month} }" class="btn btn-sm btn-info">View Salary</router-link>
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
			this.allEmployee();
		},
		data()
		{
			return {
				salaries:[],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.salaries.filter(salary => {
					return salary.salary_month.match(this.searchTerm);
				});
			}
		},
		methods: {
			allEmployee()
			{
				axios.get('api/all-salary')
				.then(response => {
					this.salaries = response.data;
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