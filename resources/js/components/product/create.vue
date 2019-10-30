<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add Product</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Product Insert
		      	<router-link to="/all-product" class="btn btn-sm btn-info" id="add_new">All Product</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="productInsert" enctype="multipart/form-data">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="inputName" class="form-control" placeholder="Product Name" autofocus="autofocus" v-model="form.product_name">
	    		              <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
	    		              <label for="inputName">Product Name</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="inputEmail" class="form-control" placeholder="Product Code" autofocus="autofocus" v-model="form.product_code">
	    		              <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
	    		              <label for="inputEmail">Product Code</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          <div class="" >
		            <div class="row">
		            	<div class="col-md-6">
		            		<div class="form-group">
		            		  <label for="category">Category</label>
	    		              <select class="form-control" id="category" v-model="form.category_id">
	    		              	<option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
	    		              </select>
	    		              <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-group">
		            		  <label for="supplier">Supplier</label>
	    		              <select class="form-control" id="supplier" v-model="form.supplier_id">
	    		              	<option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
	    		              </select>
	    		              <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="address" class="form-control" placeholder="Root" autofocus="autofocus" v-model="form.root">
	    		              <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
	    		              <label for="address">Root</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="text" id="salary" class="form-control" placeholder="Buying Price" autofocus="autofocus" v-model="form.buying_price">
	    		              <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
	    		              <label for="salary">Buying Price</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>
		          
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-4">
		            		<div class="form-label-group">
	    		              <input type="text" id="joiningDate" class="form-control" placeholder="Selling Price" autofocus="autofocus" v-model="form.selling_price">
	    		              <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
	    		              <label for="joiningDate">Selling Price</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-4">
		            		<div class="form-label-group">
	    		              <input type="date" id="nid" class="form-control" placeholder="Buying Date" autofocus="autofocus" v-model="form.buying_date">
	    		              <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
	    		              <label for="nid">Buying Date</label>
	    		            </div>
		            	</div>
		            	<div class="col-md-4">
		            		<div class="form-label-group">
	    		              <input type="text" id="phone" class="form-control" placeholder="Product Quantity" autofocus="autofocus" v-model="form.product_quantity">
	    		              <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
	    		              <label for="phone">Product Quantity</label>
	    		            </div>
		            	</div>
		            </div>
		          </div>

		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-6">
		            		<div class="form-label-group">
	    		              <input type="file" id="photo" class="btn btn-info" @change="onFileSelected">
	    		              <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
	    		            </div>
		            	</div>
		            	<div class="col-md-6">
		            		<img :src="form.image" style="height:40px;width:40px;">
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
	// 			this.$router.push({name: '/'})
	// 		}
	// 	},
	// 	data()
	// 	{
	// 		return {
	// 			form: {
	// 				name: '',
	// 				email: '',
	// 				phone: '',
	// 				salary: '',
	// 				address: '',
	// 				photo: '',
	// 				nid: '',
	// 				joiningDate: '',
	// 			},
	// 			errors: {},
	// 		}
	// 	},
	// 	methods:{
	// 		onFileSelected(event)
	// 		{
	// 			let file = event.target.files[0];
	// 			if(file.size > 1048770)
	// 			{
	// 				//console.log(event);
	// 				Notification.image_validation();
	// 			}
	// 			else
	// 			{
	// 				let reader = new FileReader();
	// 				reader.onload = event => {

	// 					this.form.photo = event.target.result;
	// 					console.log(event.target.result);

	// 				};
	// 				reader.readAsDataURL(file);
	// 			}
	// 		},
	// 		employeeInsert()
	// 		{
	// 			axios.post('api/employee',this.form)
	// 			.then(response => {
	// 				this.$router.push({name: 'all_employee'});
	// 				Notification.success();
	// 			})
	// 			.catch(error => {
	// 				this.errors = error.response.data.errors;
	// 			})
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
					product_name: '',
					product_code: '',
					category_id: '',
					supplier_id: '',
					root: '',
					buying_price: '',
					selling_price: '',
					product_quantity: '',
					buying_date: '',
					image: '',
				},
				errors: {},
				categories: {},
				suppliers: {},
			}
		},
		methods: {
			onFileSelected(event)
			{
				//console.log(event);
				let file = event.target.files[0];
				if(file.size > 1048770)
				{
					Notification.image_validation();
				}
				else
				{
					let reader = new FileReader();
					reader.onload = event => {
						this.form.image = event.target.result;
						console.log(event.target.result);
					};
					reader.readAsDataURL(file);
				}
			},
			productInsert()
			{
				axios.post('api/product',this.form)
				.then(response => {
					this.$router.push({name: 'all_product'});
					Notification.success();
				})
				.catch(error => {
					this.errors = error.response.data.errors;
				})
			},

		},
		created()
		{
			axios.get('api/category',this.form)
			.then(response => {
				this.categories = response.data;
			});

			axios.get('api/supplier')
			.then(response => {
				this.suppliers = response.data;
			});
		}
	}
</script>

<style type="text/css">

</style>