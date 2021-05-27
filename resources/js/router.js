import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

//Auth Routes
import login from './components/auth/login'
import forgot from './components/auth/forgot'
import logout from './components/auth/logout'
import register from './components/auth/register'

//Main Dashboard Routes
import dashboard from './components/dashboard'

//Employee Routes
import addemployee from './components/employee/add'
import allemployee from './components/employee/all'
import editemployee from './components/employee/edit'

//Employee Salary Routes
import pending_salary from './components/salary/pendingsalary'
import paid_salary from './components/salary/paidsalary'
import all_salary from './components/salary/allsalary'
import view_salary from './components/salary/viewsalary'

//Supplier Routes
import addsupplier from './components/supplier/add'
import allsupplier from './components/supplier/all'
import editsupplier from './components/supplier/edit'

//category routes
import expense from './components/expense/expense'

/*
*=======================
Product All Routes Start
* ======================
 */

//category routes
import category from './components/category/category'

//product routes
import addproduct from './components/product/add'
import allproduct from './components/product/all'
import editproduct from './components/product/edit'
import viewproduct from './components/product/view'

//stock management
import stock_management from './components/stock-management/stock'

// let login       = require('./components/login.vue').default;
// let register    = require('./components/register.vue').default;
// let dashboard   = require('./components/dashboard.vue').default;
export const routes = [
    { path: '/',  component: login, name: '/' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/forgot-password', component: forgot, name: 'forgot-password' },
    { path: '/register', component: register, name: 'register' },
    { path: '/dashboard', component: dashboard, name: 'dashboard' },

    //employee routes
    { path: '/add-employee', component: addemployee, name: 'add-employee' },
    { path: '/all-employee', component: allemployee, name: 'all-employee' },
    { path: '/edit-employee/:id', component: editemployee, name: 'edit-employee' },

    //employee salary routes
    { path: '/pay-salary', component: pending_salary, name: 'pending-salary' },
    { path: '/all-salary', component: all_salary, name: 'all-salary' },
    { path: '/paid-salary', component: paid_salary, name: 'paid-salary' },
    { path: '/view-salary/:id', component: view_salary, name: 'view-salary' },

    //Supplier Routes
    { path: '/add-supplier', component: addsupplier, name: 'add-supplier' },
    { path: '/all-supplier', component: allsupplier, name: 'all-supplier' },
    { path: '/edit-supplier/:id', component: editsupplier, name: 'edit-supplier' },

    //expense routes
    { path: '/expense', component: expense, name: 'expense' },

    /*
    *=======================
    Product All Routes Start
    * ======================
     */

    //category routes
    { path: '/category', component: category, name: 'category' },

    //Product Routes
    { path: '/add-product', component: addproduct, name: 'add-product' },
    { path: '/all-product', component: allproduct, name: 'all-product' },
    { path: '/edit-product/:id', component: editproduct, name: 'edit-product' },
    { path: '/view-product/:id', component: viewproduct, name: 'view-product' },

    //stock management
    { path: '/stock-management', component: stock_management, name: 'stock-management' },
]

export default new Router ({
    mode: 'history',
    routes
})
