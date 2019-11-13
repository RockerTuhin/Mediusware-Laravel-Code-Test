<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Todays Orders</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Todays Orders
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Customer Name</th>
	                    <th>Total</th>
	                    <th>Pay</th>
	                    <th>Due</th>
	                    <th>Pay By</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Customer Name</th>
	                    <th>Total</th>
	                    <th>Pay</th>
	                    <th>Due</th>
	                    <th>Pay By</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="order in filterSearch" :key="order.id">
	                  	<td>{{ order.name }}</td>
	                  	<td>{{ order.total }}</td>
	                  	<td>{{ order.pay }}</td>
	                  	<td>{{ order.due }}</td>
	                  	<td>{{ order.payby }}</td>
	                  	<td>
	                  		<router-link :to="{ name: 'view_order', params:{id: order.id} }" class="btn btn-sm btn-info">View</router-link>
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
			if(!User.loggedIn)
			{
				this.$router.push({name: '/'});
			}
			this.ordersTodays();
		},
		data()
		{
			return {
				todaysOrders: [],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.todaysOrders.filter(todaysOrder => {
					return todaysOrder.name.toLowerCase().match(this.searchTerm.toLowerCase());
				});
			}
		},
		methods: {
			ordersTodays()
			{
				axios.get('api/todays-orders')
				.then(response => {
					this.todaysOrders = response.data;
				});
			},
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