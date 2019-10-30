<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Update Product Stock</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Product Stock Update
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="stockUpdate" enctype="multipart/form-data">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-12">
		            		<div class="form-label-group">
	    		              <input type="text" id="phone" class="form-control" placeholder="Product Quantity" autofocus="autofocus" v-model="form.product_quantity">
	    		              <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
	    		              <label for="phone">Product Quantity</label>
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
					product_quantity: '',
				},
				errors: {},
			}
		},
		methods: {
			stockUpdate()
			{
				let id = this.$route.params.id;
				axios.post('/inventoryWithVueAndAPI/public/api/update-stock/'+id,this.form)
				.then(response => {
					this.$router.push({name: 'stock'});
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
			axios.get('/inventoryWithVueAndAPI/public/api/product/'+id)
			.then(response => {
				this.form = response.data;
			});
		}
	}
</script>

<style type="text/css">

</style>