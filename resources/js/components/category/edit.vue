<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Update Category</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Category Update
		      	<router-link to="/all-category" class="btn btn-sm btn-info" id="add_new">All Category</router-link>
		      </div>
		      <div class="card-body">
		        <form @submit.prevent="categoryUpdate">
		          <div class="form-group" >
		            <div class="form-row">
		            	<div class="col-md-12">
		            		<div class="form-label-group">
	    		              <input type="text" id="categoryName" class="form-control" placeholder="Category Name" autofocus="autofocus" v-model="form.category_name">
	    		              <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
	    		              <label for="categoryName">Category Name</label>
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

// <script type="text/javascript">
// 	export default {
// 		mounted()
// 		{
// 			if(!User.loggedIn())
// 			{
// 				this.$router.push({name: '/'})
// 			}
// 		},
// 		data()
// 		{
// 			return {
// 				form: {
// 					name: '',
// 					email: '',
// 					phone: '',
// 					address: '',
// 					photo: '',
// 					new_photo: '',
// 				},
// 				errors: {},
// 			}
// 		},
// 		methods:{
// 			onFileSelected(event)
// 			{
// 				let file = event.target.files[0];
// 				if(file.size > 1048770)
// 				{
// 					//console.log(event);
// 					Notification.image_validation();
// 				}
// 				else
// 				{
// 					let reader = new FileReader();
// 					reader.onload = event => {

// 						this.form.new_photo = event.target.result;
// 						console.log(event.target.result);

// 					};
// 					reader.readAsDataURL(file);
// 				}
// 			},
// 			supplierUpdate()
// 			{
// 				let id = this.$route.params.id;
// 				axios.patch('/inventoryWithVueAndAPI/public/api/supplier/'+id,this.form)
// 				.then(response => {
// 					this.$router.push({name: 'all_supplier'});
// 					Notification.success();
// 				})
// 				.catch(error => {
// 					this.errors = error.response.data.errors;
// 				})
// 			}
// 		},
// 		created()
// 		{
// 			let id = this.$route.params.id;
// 			axios.get('/inventoryWithVueAndAPI/public/api/supplier/'+id)
// 			.then(response => {
// 				this.form = response.data;
// 				console.log(response.data);
// 			})
// 			.catch(error => {
// 				console.log(error);
// 			})
// 		}
// 	}
// </script>

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
					category_name: '',
				},
				errors: {},
			}
		},
		methods: {
			categoryUpdate()
			{
				let id = this.$route.params.id;
				axios.patch('/inventoryWithVueAndAPI/public/api/category/'+id,this.form)
				.then(response => {
					this.$router.push({name: 'all_category'});
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
			axios.get('/inventoryWithVueAndAPI/public/api/category/'+id)
			.then(response => {
				this.form = response.data;
				console.log(response.data);
			})
			.catch(error => {
				console.log(error);
			})
		}
	}
</script>

<style type="text/css">

</style>