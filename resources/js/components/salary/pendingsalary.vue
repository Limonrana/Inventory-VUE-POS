<template>
    <div class="pendingsalary">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Employee Salary</h4>
                            <h6 class="card-subtitle"></h6>
                            <input type="text" class="form-control float-left m-t-10 mb-2" id="SearchData" placeholder="Search" v-model="SearchTerms">
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
<!--                                        <th>Status</th>-->
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="employee in filterSearch" :key="employee.id">
                                        <td>{{ employee.id }}</td>
                                        <td>
                                            <a href="javascript:void(0)"><img :src="employee.photo" alt="user" width="40" class="rounded-circle" /> {{ employee.name }}</a>
                                        </td>
                                        <td>{{ employee.email }}</td>
                                        <td>{{ employee.phone }}</td>
                                        <td><span class="label label-success">BDT. {{ employee.salary }}</span> </td>
<!--                                        <td>-->
<!--                                            <span class="label label-success" v-if="employee.get_salary">PAID</span>-->
<!--                                            <span class="label label-danger" v-else>PENDING</span>-->
<!--                                        </td>-->
                                        <td>
                                            <button class="btn btn-info" @click="addSalary(employee)">Pay Now</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllEmployee" v-if="pageInfo" />
                            </div>

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="addModal"
                                title="Employee Salary Pay"
                                :mask-closable="false"
                                :closable="false"
                                >
                                <label>Employee Name</label>
                                <Input v-model="form.name" disabled placeholder="Enter employee name..."/>
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                <br>
                                <label>Employee Email</label>
                                <Input v-model="form.email" disabled placeholder="Enter email address..."/>
                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                <br>
                                <label>Employee Salary</label>
                                <Input v-model="form.salary" disabled placeholder="Enter employee salary..."/>
                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                <br>
                                <label>Salary Month</label>
                                <Select v-model="form.salarymonth" placeholder="Choose">
                                    <Option value="January">January</Option>
                                    <Option value="February">February</Option>
                                    <Option value="March">March</Option>
                                    <Option value="April">April</Option>
                                    <Option value="May">May</Option>
                                    <Option value="June">June</Option>
                                    <Option value="July">July</Option>
                                    <Option value="August">August</Option>
                                    <Option value="September">September</Option>
                                    <Option value="October">October</Option>
                                    <Option value="November">November</Option>
                                    <Option value="December">December</Option>
                                </Select>
                                <small class="text-danger" v-if="errors.salarymonth">{{ errors.salarymonth[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="salaryPay(form.id)">Pay</Button>
                                    <Button type="default" @click="addModal=false">Close</Button>
                                </div>
                            </Modal>
                            <!-- End Category Popup Model -->
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "pendingsalary",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.AllEmployee()
        },
        data() {
            return {
                employees: [],
                SearchTerms: '',
                form: {
                    id: null,
                    name: null,
                    email: null,
                    salary: null,
                    salarymonth: null
                },
                errors: { },
                addModal: false,
                total: 10,
                pageInfo: null
            }
        },
        computed: {
            filterSearch() {
                return this.employees.filter(employee => {
                    return employee.name.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllEmployee(page=1) {
                axios.get(`/api/pay-employee?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.employees = data.data, this.pageInfo = data)})
                    .catch()
            },
            addSalary(employee) {
                let obj = {
                    id: employee.id,
                    name: employee.name,
                    email: employee.email,
                    salary: employee.salary
                }
                this.form = obj
                this.addModal=true
            },
            salaryPay(id) {
                axios.post('/api/pay-salary/'+id , this.form)
                    .then(data => {
                        this.addModal= false
                        this.AllEmployee()
                        this.form.name='',
                        this.form.email='',
                        this.form.salary='',
                        this.form.salary_month=''
                        //Notification.sweet_success()
                        if (data.data == 'Salary Already Paid') {
                            this.w(data.data)
                        }
                        else {
                            this.s(data.data)
                        }
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>
    #SearchData {
        width: 15%;
    }
    label {
        margin-top: 5px;
    }
</style>
