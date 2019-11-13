<template>
	<div>
		<!-- Breadcrumbs -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Search Order</li>
		</ol>
		<!-- Icon Cards -->
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Search Order
		      	<router-link to="/todays-orders" class="btn btn-sm btn-info" id="add_new">Today Order</router-link>
		      </div>
		      <div class="row">
		      	<div class="col-lg-6 col-md-6">
		      		<form @submit.prevent="searchByDate">
			          <div class="form-group" >
			            <div class="form-row">
			            	<div class="col-md-12">
			            		<div class="form-group">
								    <label for="exampleFormControlSelect2">Search by Date</label>
								    <input type="date" class="form-control" required="" v-model="date">
								</div>
			            	</div>
			            	<button type="submit" class="btn btn-success">Search</button>
			            </div>
			          </div>
			          
			          
			        </form>
		      	</div>
		      	<div class="col-lg-6 col-md-6">
		      		<form @submit.prevent="searchByMonth">
			          <div class="form-group" >
			            <div class="form-row">
			            	<div class="col-md-12">
			            		<div class="form-group">
								    <label for="exampleFormControlSelect2">Search by Month</label>
								    <select class="form-control" id="exampleFormControlSelect2" v-model="month" required="">
								      <option value="January">January</option>
								      <option value="February">February</option>
								      <option value="March">March</option>
								      <option value="April">April</option>
								      <option value="May">May</option>
								      <option value="June">June</option>
								      <option value="July">July</option>
								      <option value="August">August</option>
								      <option value="September">September</option>
								      <option value="October">October</option>
								      <option value="November">November</option>
								      <option value="December">December</option>
								    </select>
								</div>
			            	</div>
			            	<button type="submit" class="btn btn-success">Search</button>
			            </div>
			          </div>
			          
			          
			        </form>
		      	</div>
		      </div>
		    </div>
		</div>
		<div class="row container">
		    <div class="card col-lg-12">
		      <div class="card-header">
		      	<i class="fas fa-chart-area"></i>
		      	Found Orders
		      </div>
		      <div class="card-body">

		      		<div class="table-responsive" v-if="orders.length > 0">
		              <table class="table table-bordered" id="" width="100%" cellspacing="0">
		                <thead >
		                  <tr>
		                    <th>Customer Name</th>
		                    <th>Quantity</th>
		                    <th>Subtotal</th>
		                    <th>Vat</th>
		                    <th>Total</th>
		                    <th>Pay</th>
		                    <th>Due</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
		                <tfoot>
		                  <tr>
		                    <td></td>
		                    <td>{{ Quantity }} pieces</td>
		                    <td>{{ Subtotal }} TK</td>
		                    <td>{{ Total - Subtotal }} TK</td>
		                    <td>{{ Total }} TK</td>
		                    <td>{{ Pay }} TK</td>
		                    <td>{{ Due }} TK</td>
		                  </tr>
		                </tfoot>
		                <tbody>
		                  <tr v-for="order in orders" :key="order.id">
		                  	<td>{{ order.name }}</td>
		                  	<td>{{ order.total_quantity }}</td>
		                  	<td>{{ order.subtotal }}</td>
		                  	<td>{{ order.vat }} %</td>
		                  	<td>{{ order.total }}</td>
		                  	<td>{{ order.pay }}</td>
		                  	<td>{{ order.due }}</td>
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
			if(!User.loggedIn())
			{
				this.$router.push({name: '/'});
			}
		},
		data()
		{
			return {
				date: '',
				month: '',
				orders: [],
			}
		},
		computed: {
			Quantity()
			{	
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++)
				{
					sum = sum + parseFloat(this.orders[i].total_quantity);
				}
				return sum; 
			},
			Subtotal()
			{
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++)
				{
					sum = sum + parseFloat(this.orders[i].subtotal);
				}
				return sum; 
			},
			Total()
			{
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++)
				{
					sum = sum + parseFloat(this.orders[i].total);
				}
				return sum; 
			},
			Pay()
			{
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++)
				{
					sum = sum + parseFloat(this.orders[i].pay);
				}
				return sum; 
			},
			Due()
			{
				let sum = 0;
				for(let i = 0; i < this.orders.length; i++)
				{
					sum = sum + parseFloat(this.orders[i].due);
				}
				return sum; 
			},
		},
		methods:{
			searchByDate(){
				let data = {date: this.date};
				axios.post('api/search-by-date',data)
				.then(response => {
					this.orders = response.data;
				})
				.catch()
			},
			searchByMonth(){
				let data = {month: this.month}
				axios.post('api/search-by-month',data)
				.then(response => {
					this.orders = response.data;
				})
				.catch()
			},
		}

	}
</script>