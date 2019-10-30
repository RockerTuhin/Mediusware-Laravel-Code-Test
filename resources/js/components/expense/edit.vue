<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Update Expense</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Expense Update
		      	<router-link to="/all-expense" class="btn btn-sm btn-info" id="add_new">All Expense</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="expenseUpdate">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-12">
    		                <label for="validationTextarea">Details</label>
						    <textarea class="form-control" id="validationTextarea" placeholder="Details of Expense" v-model="form.details"></textarea>
    		                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
		            	</div>
		            </div>
		          </div>
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-12">
		            		<div class="form-label-group">
	    		              <input type="text" id="expense" class="form-control" placeholder="Amount" autofocus="autofocus" v-model="form.amount">
	    		              <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
	    		              <label for="expense">Amount</label>
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
	// 				category_name: '',
	// 			},
	// 			errors: {},
	// 		}
	// 	},
	// 	methods: {
	// 		categoryUpdate()
	// 		{
	// 			let id = this.$route.params.id;
	// 			axios.patch('/inventoryWithVueAndAPI/public/api/category/'+id,this.form)
	// 			.then(response => {
	// 				this.$router.push({name: 'all_category'});
	// 				Notification.success();
	// 			})
	// 			.catch(error => {
	// 				this.errors = error.response.data.errors;
	// 			})
	// 		}
	// 	},
	// 	created()
	// 	{
	// 		let id = this.$route.params.id;
	// 		axios.get('/inventoryWithVueAndAPI/public/api/category/'+id)
	// 		.then(response => {
	// 			this.form = response.data;
	// 			console.log(response.data);
	// 		})
	// 		.catch(error => {
	// 			console.log(error);
	// 		})
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
					details: '',
					amount: '',
				},
				errors: {},
			}
		},
		methods: {
			expenseUpdate()
			{
				let id = this.$route.params.id;
				axios.patch('/inventoryWithVueAndAPI/public/api/expense/'+id,this.form)
				.then(response => {
					this.$router.push({name: 'all_expense'});
					Notification.success();
				})
			}
		},
		created()
		{	
			let id = this.$route.params.id;
			axios.get('/inventoryWithVueAndAPI/public/api/expense/'+id)
			.then(response => {
				this.form = response.data;
			})
		}
	}
</script>

<style type="text/css">

</style>