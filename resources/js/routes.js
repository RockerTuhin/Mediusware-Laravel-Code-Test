
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget_password = require('./components/auth/forget_password.vue').default;
let home = require('./components/home.vue').default;
let logout = require('./components/auth/logout.vue').default;
//end authentication components
//Employee components start
let addEmployee = require('./components/employee/create').default;
let allEmployee = require('./components/employee/index').default;
let editEmployee = require('./components/employee/edit').default; 
//Supplier components start
let addSupplier = require('./components/supplier/create').default;
let allSupplier = require('./components/supplier/index').default;
let editSupplier = require('./components/supplier/edit').default;
//Category components start
let addCategory = require('./components/category/create').default;
let allCategory = require('./components/category/index').default;
let editCategory = require('./components/category/edit').default;
//Product components start
let addProduct = require('./components/product/create').default;
let allProduct = require('./components/product/index').default;
let editProduct = require('./components/product/edit').default;
//Expense Components start
let addExpense = require('./components/expense/create').default;
let allExpense = require('./components/expense/index').default;
let editExpense = require('./components/expense/edit').default;
//Salary Components start
let employeeList = require('./components/salary/employee_list').default;
let paySalary = require('./components/salary/pay_salary').default;
let allSalary = require('./components/salary/all_salary').default;
let viewSalary = require('./components/salary/view_salary').default;
let editSalary = require('./components/salary/edit_salary').default;
//Stock Components start
let stock = require('./components/product/stock').default;
let editStock = require('./components/product/edit_stock').default;
//Customer Components start
let addCustomer = require('./components/customer/create').default;
let allCustomer = require('./components/customer/index').default;
let editCustomer = require('./components/customer/edit').default;
//POS Components start
let pos = require('./components/pos/pointofsale').default;

export const routes = [

  { path: '/', component: login,name: '/' },
  { path: '/register', component: register,name: 'register' },
  { path: '/forget-password', component: forget_password,name: 'forget_password' },
  { path: '/home', component: home, name: 'home' },
  { path: '/logout', component: logout, name: 'logout' },
  //employee routes start
  { path: '/add-employee', component: addEmployee, name: 'add_employee' },
  { path: '/all-employee', component: allEmployee, name: 'all_employee' },
  { path: '/edit-employee/:id', component: editEmployee , name: 'edit_employee' },
  //supplier routes start
  { path: '/add-supplier', component: addSupplier, name: 'add_supplier' },
  { path: '/all-supplier', component: allSupplier, name: 'all_supplier' },
  { path: '/edit-supplier/:id', component: editSupplier, name: 'edit_supplier' },
  //Category routes start
  { path: '/add-category', component: addCategory, name: 'add_category' },
  { path: '/all-category', component: allCategory, name: 'all_category' },
  { path: '/edit-category/:id', component: editCategory, name: 'edit_category' },
  //Product routes start
  { path: '/add-product', component: addProduct, name: 'add_product' },
  { path: '/all-product', component: allProduct, name: 'all_product' },
  { path: '/edit-product/:id', component: editProduct, name: 'edit_product' },
  //Expense routes start
  { path: '/add-expense', component: addExpense, name: 'add_expense' },
  { path: '/all-expense', component: allExpense, name: 'all_expense' },
  { path: '/edit-expense/:id', component: editExpense, name: 'edit_expense' },
  //Salary routes start
  { path: '/employee-list', component: employeeList, name: 'employee_list' },
  { path: '/pay-salary/:id', component: paySalary, name: 'pay_salary' },
  { path: '/all-salary', component: allSalary, name: 'all_salary' },
  { path: '/view-salary/:month', component: viewSalary, name: 'view_salary' },
  { path: '/edit-salary/:id', component: editSalary, name: 'edit_salary' },
  //Stock routes start
  { path: '/stock', component: stock, name: 'stock' },
  { path: '/edit-stock/:id', component: editStock, name: 'edit_stock' },
  //Customer routes start
  { path: '/add-customer', component: addCustomer, name: 'add_customer' },
  { path: '/all-customer', component: allCustomer, name: 'all_customer' },
  { path: '/edit-customer/:id', component: editCustomer, name: 'edit_customer' },
  //POS routes start
  { path: '/pos', component: pos, name: 'pos' },

]

