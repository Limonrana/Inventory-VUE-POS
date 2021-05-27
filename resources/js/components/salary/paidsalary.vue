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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="employee in filterSearch" :key="employee.id">
                                        <td>{{ employee.id }}</td>
                                        <td>
                                            <a href="javascript:void(0)"><img :src="employee.get_employee.photo" alt="user" width="40" class="rounded-circle" /> {{ employee.get_employee.name }}</a>
                                        </td>
                                        <td>{{ employee.get_employee.email }}</td>
                                        <td>{{ employee.get_employee.phone }}</td>
                                        <td><span class="label label-success">BDT. {{ employee.get_employee.salary }}</span> </td>
                                        <td>
                                            <span class="label label-info">{{ employee.salary_month }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-info">{{ employee.salary_year }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-info">{{ employee.salary_date }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-success">PAID</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllEmployee" v-if="pageInfo" />
                            </div>
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
            total: 10,
            pageInfo: null
        }
    },
    computed: {
        filterSearch() {
            return this.employees.filter(employee => {
                return employee.salary_date.match(this.SearchTerms) || employee.salary_month.match(this.SearchTerms)
            })
        }
    },
    methods: {
        AllEmployee(page=1) {
            axios.get(`/api/paid-employee?page=${page}&total=${this.total}`)
                .then(({data}) => {(this.employees = data.data, this.pageInfo = data)})
                .catch()
        }
    }
}
</script>

<style scoped>
#SearchData {
    width: 15%;
}
</style>
