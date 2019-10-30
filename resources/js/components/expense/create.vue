<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add Expense</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Expense Insert
		      	<router-link to="/all-expense" class="btn btn-sm btn-info" id="add_new">All Expense</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="expenseInsert">
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
	// 			this.$router.push({name: '/'});
	// 		}
	// 	},
	// 	data()
	// 	{
	// 		return {
	// 			form:{
	// 				category_name: '',
	// 			},
	// 			errors:[],
	// 		}
	// 	},
	// 	methods:{
	// 		categoryInsert(){
	// 			axios.post('api/category',this.form)
	// 			.then(response => {
	// 				this.$router.push({name: 'all_category'});
	// 				Notification.success();
	// 			})
	// 			.catch()
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
					details: '',
					amount: '',
				},
				errors: {},
			}
		},
		methods: {
			expenseInsert()
			{
				axios.post('api/expense',this.form)
				.then(response => {
					this.$router.push({name: 'all_expense'});
					Notification.success();
				})
				.catch(error =>{
					this.errors = error.response.data.errors;
				})
			}
		}
	}
</script>