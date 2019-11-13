<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Point of Sale</li>
		</ol>
		<div class="row">
			<div class="col-lg-5 col-md-5">
				<div class="row card container">
			      <div class="card-header">
			      	<i class="fas fa-chart-area"></i>
			      	POS
			      	<a class="btn btn-sm btn-info align-right" id="add_new" data-toggle="modal" data-target="#exampleModal">Add Customer</a>
			      </div>
			      <!-- Customer add modal -->
			      <!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <form @submit.prevent="customerInsert" enctype="multipart/form-data">
					          <div class="form-group" >
					            <div class="form-row">
					            	<div class="col-md-6">
					            		<div class="form-label-group">
				    		              <input type="text" id="inputName" class="form-control" placeholder="Full Name" autofocus="autofocus" v-model="form.name">
				    		              <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
				    		              <label for="inputName">Full Name</label>
				    		            </div>
					            	</div>
					            	<div class="col-md-6">
					            		<div class="form-label-group">
				    		              <input type="text" id="inputEmail" class="form-control" placeholder="Email" autofocus="autofocus" v-model="form.email">
				    		              <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
				    		              <label for="inputEmail">Email Address</label>
				    		            </div>
					            	</div>
					            </div>
					          </div>
					          
					          <div class="form-group" >
					            <div class="form-row">
					            	<div class="col-md-6">
					            		<div class="form-label-group">
				    		              <input type="text" id="address" class="form-control" placeholder="Address" autofocus="autofocus" v-model="form.address">
				    		              <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
				    		              <label for="address">Address</label>
				    		            </div>
					            	</div>
					            	<div class="col-md-6">
					            		<div class="form-label-group">
				    		              <input type="text" id="phone" class="form-control" placeholder="Phone Number" autofocus="autofocus" v-model="form.phone">
				    		              <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
				    		              <label for="phone">Phone Number</label>
				    		            </div>
					            	</div>
					            </div>
					          </div>
					          <div class="form-group" >
					            <div class="form-row">
					            	<div class="col-md-6">
					            		<div class="form-label-group">
				    		              <input type="file" id="photo" class="btn btn-info" @change="onFileSelected">
				    		              <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
				    		            </div>
					            	</div>
					            	<div class="offset-md-4 col-md-2">
					            		<img :src="form.photo" style="height:40px;width:40px;">
					            	</div>
					            </div>
					          </div>
						      <button type="submit" class="btn btn-success">Submit</button>
					        </form>
					      </div>
					    </div>
					  </div>
					</div>
			      <!-- End Customer add modal -->
			      
			      	<div class="card-body">
			       		<table class="table table-sm table-striped">
						  <thead>
						    <tr>
						      <th scope="col">Name</th>
						      <th scope="col">Qty</th>
						      <th scope="col">Unit</th>
						      <th scope="col">Total</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr v-for="cart in carts">
						      <td>{{ cart.product_name }}</th>
						      <td>
						      	<input style="width:20px" :value="cart.product_quantity" readonly="">
						      	<button @click.prevent="incrementQuantity(cart.id)" class="btn btn-sm btn-success">+</button>
						      	<button @click.prevent="decrementQuantity(cart.id)" class="btn btn-sm btn-danger" v-if="cart.product_quantity > 1">-</button>
						      	<button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>
						      </td>
						      <td>{{ cart.product_price }}</td>
						      <td>{{ cart.subtotal }}</td>
						      <td><a class="btn btn-sm btn-danger" @click.prevent="removeItem(cart.id)">x</a></td>
						    </tr>
						  </tbody>
						</table>
						<hr>
			        </div>
			        <div class="card-footer">
			        	<ul class="list-group">
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Total Quantity:
						    <strong>{{ totalQuantity }}</strong>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Sub Total:
						    <strong>{{ totalSubtotal }}</strong>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Vat:
						    <strong>{{ vats.vat }} %</strong>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
						    Total:
						    <strong>{{ (((totalSubtotal * vats.vat) / 100) + totalSubtotal) }}</strong>
						  </li>
						</ul>
						<br>
						<form @submit.prevent="orderDone">
							<div class="">
								<label>Customer Name</label>
								<select class="form-control" v-model="customer_id">
									<option :value="customer.id" v-for="customer in customers">{{ customer.name }}</option>
								</select>
								<small class="text-danger" v-if="errors.customer_id">{{ errors.customer_id[0] }}</small>
							</div>
							<label>Pay</label>
							<input type="" class="form-control" v-model="pay">

							<label>Due</label>
							<input type="" class="form-control" v-model="due" readonly="">
							<div class="">
								<label>Pay By</label>
								<select class="form-control" v-model="payBy">
									<option value="HandCash">Hand Cash</option>
									<option value="Cheaque">Cheaque</option>
									<option value="GiftCard">Gift Card</option>
								</select>
								<small class="text-danger" v-if="errors.payBy">{{ errors.payBy[0] }}</small>
							</div>
							<br>
							<button type="submit" class="btn btn-success">Submit</button>
						</form>
			        </div>
				</div>
			</div>
			<div class="col-lg-7 col-md-7">
				<div class="row card container">
			      <div class="card-header">
			      	<i class="fas fa-chart-area"></i>
			      	Products
			      </div>
			      <!-- Category wise Product -->
			      	<div class="card-body">
			      		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Product</a>
						  </li>
						  <li class="nav-item" v-for="category in categories">
						    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="categoryWiseProducts(category.id)">{{ category.category_name }}</a>
						  </li>
				        </ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						   		<input type="text" class="form-control" placeholder="Search" v-model="searchTerm"><br>
					       		<div class="row">
						     		<div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch">
							      		<button class="btn btn-sm" @click.prevent="addToCart(product.id)" :disabled="product.product_quantity > 0 ? disabled : '' ">
								       		<div class="card" style="width: 7rem;">
												<img :src="product.image" id="employee_photo" class="card-img-top">
												<div class="card-body">
													<small class="card-title">{{ product.product_name }}</small>
													<span v-if="product.product_quantity > 0" class="badge badge-success">Available ({{ product.product_quantity }})</span>
					                    			<span v-else="" class="badge badge-danger">Stock Out</span>
											  	</div>
								       		</div>
							      		</button>
						     		</div>
					       		</div>
							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<input type="text" class="form-control" placeholder="Search" v-model="searchTerm"><br>
					       		<div class="row">
						     		<div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="categoryProduct in categoryWiseProductFilterSearch">
							      		<button class="btn btn-sm" @click.prevent="addToCart(categoryProduct.id)" :disabled="categoryProduct.product_quantity > 0 ? disabled : '' ">
								       		<div class="card" style="width: 7rem;">
												<img :src="categoryProduct.image" id="employee_photo" class="card-img-top">
												<div class="card-body">
													<small class="card-title">{{ categoryProduct.product_name }}</small>
													<span v-if="categoryProduct.product_quantity > 0" class="badge badge-success">Available ({{ categoryProduct.product_quantity }})</span>
					                    			<span v-else="" class="badge badge-danger">Stock Out</span>
											  	</div>
								       		</div>
							      		</button>
						     		</div>
					       		</div>
							</div>
						</div>
			      	</div>
				</div>
			</div>
		</div>
		<!-- Icon Cards -->
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
			this.allProducts();
			this.allCategories();
			this.allCustomers();
			this.showCart();
			this.vat();
			Reload.$on('myEvent',() => {
				this.showCart();
			});
		},
		data()
		{
			return {
				searchTerm: '',
				products: [],
				customers: [],
				categories: [],
				categoryProducts: [],
				carts: [],
				vats: [],
				customer_id: '',
				pay: '',
				due: '',
				payBy: '',
				form: {
					name: '',
					email: '',
					phone: '',
					address: '',
					photo: '',
				},
				errors: {},
			}
		},
		computed: {
			filterSearch()
			{
				return this.products.filter(product => {
					return product.product_name.toLowerCase().match(this.searchTerm.toLowerCase());
				});
			},
			categoryWiseProductFilterSearch()
			{
				return this.categoryProducts.filter(categoryProduct => {
					return categoryProduct.product_name.toLowerCase().match(this.searchTerm.toLowerCase());
				});
			},
			totalQuantity()
			{
				let sum = 0;
				for(let i = 0; i < this.carts.length;i++)
				{
					sum += parseFloat(this.carts[i].product_quantity);
				}
				return sum;
			},
			totalSubtotal()
			{
				let sum = 0;
				for(let i = 0; i < this.carts.length;i++)
				{
					sum += parseFloat(this.carts[i].subtotal);
				}
				return sum;
			}
		},
		watch:{
			pay()
			{
				if(this.pay.length > 0){
					this.due = (((this.totalSubtotal * this.vats.vat) / 100) + this.totalSubtotal) - this.pay;
				}
				else{
					this.due = 0;
				}
			}
		},
		methods: {
			// Cart methods start
			addToCart(id)
			{
				let user_id = User.id();
				axios.get('api/add-to-cart/'+id+'/'+user_id)
				.then(response => {
					this.showCart();
					Notification.cart_success();
				})
			},
			showCart()
			{
				axios.get('api/show-cart')
				.then(response => {
					this.carts = response.data;
				})
			},
			removeItem(id)
			{
				let user_id = User.id();
				axios.get('api/remove-from-cart/'+id+'/'+user_id)
				.then(response => {
					this.showCart();
					Notification.success();
				})
			},
			incrementQuantity(id)
			{
				let user_id = User.id();
				axios.get('api/increment-quantity/'+id+'/'+user_id)
				.then(response => {
					this.showCart();
					Notification.success();
				})
			},
			decrementQuantity(id)
			{
				let user_id = User.id();
				axios.get('api/decrement-quantity/'+id+'/'+user_id)
				.then(response => {
					Reload.$emit('myEvent');
					Notification.success();
				})
			},
			// Cart methods end
			allProducts()
			{
				axios.get('api/product')
				.then(response => {
					this.products = response.data;
				})
			},
			allCategories()
			{
				axios.get('api/category')
				.then(response => {
					this.categories = response.data;
				})
			},
			allCustomers()
			{
				axios.get('api/customer')
				.then(response => {
					this.customers = response.data;
				})
			},
			categoryWiseProducts(id)
			{
				axios.get('api/categorywise-product/'+id)
				.then(response => {
					this.categoryProducts = response.data;
				});
			},
			onFileSelected(event)
			{
				let file = event.target.files[0];
				if(file.size > 1048770)
				{
					Notification.image_validation();
				}
				else
				{
					let reader = new FileReader();
					reader.onload = event => {
						this.form.photo = event.target.result;
						console.log(event.target.result);
					};
					reader.readAsDataURL(file);
				}
			},
			customerInsert()
			{
				axios.post('api/customer',this.form)
				.then(response => {
					$('#closeModal').click();
					Notification.success();
					this.allCustomers();
					// this.customers = this.customers.filter(customer => {
			  // 			return customer.id != id;
			  // 		})

				})
				.catch(error => {
					this.errors = error.response.data.errors;
				})
			},
			vat()
			{
				axios.get('api/vats')
				.then(response => {
					this.vats = response.data;
				});
			},
			orderDone()
			{
				let user_id = User.id();
				let total = (((this.totalSubtotal * this.vats.vat) / 100) + this.totalSubtotal);
				let data = {totalQuantity: this.totalQuantity,totalSubtotal: this.totalSubtotal,vat: this.vats.vat,total: total,customer_id: this.customer_id,pay: this.pay,due: this.due,payBy: this.payBy,user_id: user_id};
				axios.post('api/orderdone',data)
				.then(response => {
					Notification.success();
					this.$router.push({name: 'home'});
				})
				.catch(error => {
					this.errors = error.response.data.errors;
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
		width: 100px;
		height: 90px;
	}
	a.disabled {
	  pointer-events: none;
	  cursor: default;
	}
</style>