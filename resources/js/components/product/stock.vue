<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">All Product</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	All Product
		      	<router-link to="/add-product" class="btn btn-sm btn-info align-right" id="add_new">Add Product</router-link>
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Name</th>
	                    <th>Code</th>
	                    <th>Photo</th>
	                    <th>Category</th>
	                    <th>Supplier</th>
	                    <th>Buying Price</th>
	                    <th>Status</th>
	                    <th>Quantity</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Name</th>
	                    <th>Code</th>
	                    <th>Photo</th>
	                    <th>Category</th>
	                    <th>Supplier</th>
	                    <th>Buying Price</th>
	                    <th>Status</th>
	                    <th>Quantity</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="product in filterSearch">
	                  	<td>{{ product.product_name }}</td>
	                    <td>{{ product.product_code }}</td>
	                    <td><img :src="product.image" id="employee_photo"></td>
	                    <td>{{ product.category_name }}</td>
	                    <td>{{ product.name }}</td>
	                    <td>{{ product.buying_price }}</td>
	                    <td v-if="product.product_quantity > 0"><span class="badge badge-success">Available</span></td>
	                    <td v-else=""><span class="badge badge-danger">Stock Out</span></td>
	                    <td>{{ product.product_quantity }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'edit_stock', params:{id: product.id} }" class="btn btn-sm btn-info">Edit</router-link>
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
			this.allProduct();
		},
		data()
		{
			return {
				products: [],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.products.filter(product => {
					return product.product_name.match(this.searchTerm);
				})
			}
		},
		methods: {
			allProduct()
			{
				axios.get('api/product')
				.then(response => {
					this.products = response.data;
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