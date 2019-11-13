<template>
	<div>
		<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{ today_sell }} Taka</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Sell</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">{{ today_income }} Taka</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Income</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">{{ today_due }} Taka</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Due</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">{{ today_expense }} Taka</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Today Expense</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Stockout Products</div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Photo</th>
                      <th>Buying Price</th>
                      <th>Status</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Photo</th>
                      <th>Buying Price</th>
                      <th>Status</th>
                      <th>Quantity</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <tr v-for="product in stockout_products">
                      <td>{{ product.product_name }}</td>
                      <td>{{ product.product_code }}</td>
                      <td><img :src="product.image" id="employee_photo"></td>
                      <td>{{ product.buying_price }}</td>
                      <td v-if="product.product_quantity > 0"><span class="badge badge-success">Available</span></td>
                      <td v-else=""><span class="badge badge-danger">Stock Out</span></td>
                      <td>{{ product.product_quantity }}</td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
           
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

	</div>
</template>

<script type="text/javascript">
	   export default {
        created()
        {
            if(!User.loggedIn())
            {
                this.$router.push({name: '/'})
            }
            this.todaySell();
            this.todayIncome();
            this.todayDue();
            this.todayExpense();
            this.stockoutProducts();
        },
        data()
        {
            return {
                today_sell: '',
                today_income: '',
                today_due: '',
                today_expense: '',
                stockout_products: '',
            }
        },
        methods: {
            todaySell()
            {
                axios.get('api/today-sell')
                .then(response => {
                    this.today_sell = response.data;
                })
            },
            todayIncome()
            {
                axios.get('api/today-income')
                .then(response => {
                    this.today_income = response.data;
                })
            },
            todayDue()
            {
                axios.get('api/today-due')
                .then(response => {
                    this.today_due = response.data;
                })
            },
            todayExpense()
            {
                axios.get('api/today-expense')
                .then(response => {
                    this.today_expense = response.data;
                })
            },
            stockoutProducts()
            {
                axios.get('api/stockout-products')
                .then(response => {
                    this.stockout_products = response.data;
                })
            }
        }
     }
</script>

<style type="text/css">
	
</style>