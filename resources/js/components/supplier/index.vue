<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">All Supplier</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	All Supplier
		      	<router-link to="/add-supplier" class="btn btn-sm btn-info align-right" id="add_new">Add Supplier</router-link>
		      </div>
		      <div class="card-body">
		      	<label>Search:</label>
		      	<input type="text" v-model="searchTerm">
		        <div class="table-responsive">
	              <table class="table table-bordered" id="" width="100%" cellspacing="0">
	                <thead>
	                  <tr>
	                    <th>Name</th>
	                    <th>Phone</th>
	                    <th>Photo</th>
	                    <th>Shop Name</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                    <th>Name</th>
	                    <th>Phone</th>
	                    <th>Photo</th>
	                    <th>Shopname</th>
	                    <th>Action</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	                  <tr v-for="supplier in filterSearch" :key="supplier.id">
	                    <td>{{ supplier.name }}</td>
	                    <td>{{ supplier.phone }}</td>
	                    <td><img :src="supplier.photo" id="supplier_photo"></td>
	                    <td>{{ supplier.shopname }}</td>
	                    <td>
	                    	<router-link :to="{ name: 'edit_supplier', params:{id: supplier.id} }" class="btn btn-sm btn-info">Edit</router-link>
	                    	<a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
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
			if(!User.loggedIn())
			{
				this.$router.push({name: '/'});
			}
			this.allSupplier();
		},
		data()
		{
			return {
				suppliers:[],
				searchTerm: '',
			}
		},
		computed: {
			filterSearch()
			{
				return this.suppliers.filter(supplier => {
					return supplier.phone.match(this.searchTerm) || supplier.name.match(this.searchTerm);
				});
			}
		},
		methods: {
			allSupplier()
			{
				axios.get('api/supplier')
				.then(response => {
					this.suppliers = response.data;
					console.log(response.data);
				})
				.catch(error => {
					console.log(error)
				})
			},
			deleteSupplier(id)
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
				  	axios.delete('api/supplier/'+id)
				  	.then(() => {
				  		this.suppliers = this.suppliers.filter(supplier => {
				  			return supplier.id != id;
				  		})
				  	})
				  	.catch(() => {
				  		this.$router.push({name: 'all_supplier'});
				  	})
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
			}
		},
		
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