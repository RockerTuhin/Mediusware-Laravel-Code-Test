<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Order Details</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Orders
		      </div>
		      <div class="card-body">
		        <div class="row">
		        	<div class="col-md-6 col-lg-6 col-6">
		        		<ul class="list-group">
						  <li class="list-group-item bg-info text-white">Customer Details</li>
						  <li class="list-group-item">Name: {{ singleOrder.name }}</li>
						  <li class="list-group-item">Phone: {{ singleOrder.phone }}</li>
						  <li class="list-group-item">Address: {{ singleOrder.address }}</li>
						  <li class="list-group-item">Order Date: {{ singleOrder.order_date }}</li>
						  <li class="list-group-item">Total Quantity: {{ singleOrder.total_quantity }}</li>
						</ul>
		        	</div>
		        	<div class="col-md-6 col-lg-6 col-6">
		        		<ul class="list-group">
						  <li class="list-group-item">Sub Total: {{ singleOrder.subtotal }}</li>
						  <li class="list-group-item">Vat: {{ singleOrder.vat }} %</li>
						  <li class="list-group-item">Total: {{ singleOrder.total }}</li>
						  <li class="list-group-item">Pay: {{ singleOrder.pay }}</li>
						  <li class="list-group-item">Due: {{ singleOrder.due }}</li>
						  <li class="list-group-item">Pay By: {{ singleOrder.payby }}</li>
						</ul>
		        	</div>
		        </div>
		      </div>
		    </div>
		</div><br>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Order Details
		      </div>
		      <div class="card-body">
		         <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Product Name</th>
	                    <th>Code</th>
	                    <th>Image</th>
	                    <th>Qty</th>
	                    <th>Unit Price</th>
	                    <th>Total</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Product Name</th>
	                    <th>Code</th>
	                    <th>Image</th>
	                    <th>Qty</th>
	                    <th>Unit Price</th>
	                    <th>Total</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="singleOrderDetail in singleOrderDetails">
	                  	<td>{{ singleOrderDetail.product_name }}</td>
	                  	<td>{{ singleOrderDetail.product_code }}</td>
	                  	<td><img :src="'/inventoryWithVueAndAPI/public/'+singleOrderDetail.image" id="employee_photo"></td>
	                  	<td>{{ singleOrderDetail.product_quantity }}</td>
	                  	<td>{{ singleOrderDetail.product_price }}</td>
	                  	<td>{{ singleOrderDetail.subtotal }}</td>
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
				this.$router.push({name: '/'})
			}
		},
		data()
		{
			return {
				errors: {},
				singleOrder: [],
				singleOrderDetails: [],
			}
		},
		methods: {
			
		},
		created()
		{
			let id = this.$route.params.id;
			axios.get('/inventoryWithVueAndAPI/public/api/single-order/'+id)
			.then(response => {
				this.singleOrder = response.data
			})
			axios.get('/inventoryWithVueAndAPI/public/api/single-order-details/'+id)
			.then(response => {
				this.singleOrderDetails = response.data;
				this.singleOrderDetails.image = "/inventoryWithVueAndAPI/public/"+this.singleOrderDetails.image;
			})
		}
	}
</script>

<style type="text/css">
#employee_photo {
	width: 6opx;
	height: 60px;
}
</style>