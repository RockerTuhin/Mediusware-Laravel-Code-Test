<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">All Employee</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	All Employee
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Name</th>
	                    <th>Phone</th>
	                    <th>Photo</th>
	                    <th>Salary</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Name</th>
	                    <th>Phone</th>
	                    <th>Photo</th>
	                    <th>Salary</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="employee in filterSearch" :key="employee.id">
	                    <td>{{ employee.name }}</td>
	                    <td>{{ employee.phone }}</td>
	                    <td><img :src="employee.photo" id="employee_photo"></td>
	                    <td>{{ employee.salary }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'pay_salary', params:{id: employee.id} }" class="btn btn-sm btn-info">Pay Salary</router-link>
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
				employees:[],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.employees.filter(employee => {
					return employee.phone.match(this.searchTerm) || employee.name.match(this.searchTerm);
				});
			}
		},
		methods: {
			allEmployee()
			{
				axios.get('api/employee')
				.then(response => {
					this.employees = response.data;
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