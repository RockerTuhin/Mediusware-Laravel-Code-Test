<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">All Expense</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	All Expense
		      	<router-link to="/add-expense" class="btn btn-sm btn-info align-right" id="add_new">Add Expense</router-link>
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Details</th>
	                    <th>Amount</th>
	                    <th>Expense Date</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Details</th>
	                    <th>Amount</th>
	                    <th>Expense Date</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <!-- <tr v-for="category in filterSearch" :key="category.id">
	                    <td>{{ category.category_name }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'edit_category', params:{id: category.id} }" class="btn btn-sm btn-info">Edit</router-link>
	                    	<a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
	                    </td>
	                  </tr> -->
	                  <tr v-for="expense in filterSearch" :key="expense.id">
	                  	<td>{{ expense.details }}</td>
	                  	<td>{{ expense.amount }}</td>
	                  	<td>{{ expense.expense_date }}</td>
	                  	<td>
	                  		<router-link :to="{ name: 'edit_expense', params:{id: expense.id} }" class="btn btn-sm btn-info">Edit</router-link>
	                  		<a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger">Delete</a>
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
	// export default {
	// 	mounted()
	// 	{
	// 		if(!User.loggedIn())
	// 		{
	// 			this.$router.push({name: '/'});
	// 		}
	// 		this.allCategory();
	// 	},
	// 	data()
	// 	{
	// 		return {
	// 			categories:[],
	// 			searchTerm: '',
	// 		}
	// 	},
	// 	computed: {
	// 		filterSearch()
	// 		{
	// 			return this.categories.filter(category => {
	// 				return category.category_name.match(this.searchTerm);
	// 			});
	// 		}
	// 	},
	// 	methods: {
	// 		allCategory()
	// 		{
	// 			axios.get('api/category')
	// 			.then(response => {
	// 				this.categories = response.data;
	// 				console.log(response.data);
	// 			})
	// 			.catch(error => {
	// 				console.log(error)
	// 			})
	// 		},
	// 		deleteCategory(id)
	// 		{
	// 			Swal.fire({
	// 			  title: 'Are you sure?',
	// 			  text: "You won't be able to revert this!",
	// 			  type: 'warning',
	// 			  showCancelButton: true,
	// 			  confirmButtonColor: '#3085d6',
	// 			  cancelButtonColor: '#d33',
	// 			  confirmButtonText: 'Yes, delete it!'
	// 			}).then((result) => {
	// 			  if (result.value) {
	// 			  	axios.delete('api/category/'+id)
	// 			  	.then(() => {
	// 			  		this.categories = this.categories.filter(category => {
	// 			  			return category.id != id;
	// 			  		})
	// 			  	})
	// 			  	.catch(() => {
	// 			  		this.$router.push({name: 'all_supplier'});
	// 			  	})
	// 			    Swal.fire(
	// 			      'Deleted!',
	// 			      'Your file has been deleted.',
	// 			      'success'
	// 			    )
	// 			  }
	// 			})
	// 		}
	// 	},
		
	// }
</script>
<script type="text/javascript">
	export default {
		mounted()
		{
			if(!User.loggedIn)
			{
				this.$router.push({name: '/'});
			}
			this.allExpense();
		},
		data()
		{
			return {
				expenses: [],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.expenses.filter(expense => {
					return expense.expense_date.match(this.searchTerm) || expense.amount.match(this.searchTerm) || expense.details.match(this.searchTerm);
				});
			}
		},
		methods: {
			allExpense()
			{
				axios.get('api/expense')
				.then(response => {
					this.expenses = response.data;
				});
			},
			deleteExpense(id)
			{
				Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.value) {
				  	axios.delete('api/expense/'+id)
				  	.then(response => {
				  		this.expenses = this.expenses.filter(expense => {
				  			return expense.id != id;
				  		})
				  	})
				  	.catch(error => {
				  		this.$router.push({name: 'all_expense'});
				  	})
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
			}
		}


	}
</script>

<style type="text/css">
	#add_new {
		float: right;
	}
	#supplier_photo {
		width: 60px;
		height: 60px;
	}
</style>