<template>
    <div class="viewsalary">
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
                                    <tr v-for="salary in filterSearch" :key="salary.id">
                                        <td>{{ salary.id }}</td>
                                        <td>
                                            {{ salary.get_employee.name }}
                                        </td>
                                        <td>{{ salary.get_employee.email }}</td>
                                        <td>{{ salary.get_employee.phone }}</td>
                                        <td><span class="label label-success">BDT. {{ salary.get_employee.salary }}</span> </td>
                                        <td>
                                            <span class="label label-info">{{ salary.salary_month }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-info">{{ salary.salary_year }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-info">{{ salary.salary_date }}</span>
                                        </td>
                                        <td>
                                            <span class="label label-success">PAID</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllSalary" v-if="pageInfo" />
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
    name: "viewsalary",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({name: '/'})
        }
        this.AllSalary()
    },
    data() {
        return {
            salaries: [],
            SearchTerms: '',
            total: 10,
            pageInfo: null
        }
    },
    computed: {
        filterSearch() {
            return this.salaries.filter(salary => {
                return salary.salary_date.match(this.SearchTerms) || salary.salary_month.match(this.SearchTerms)
            })
        }
    },
    methods: {
        AllSalary(page=1) {
            let id = this.$route.params.id
            axios.get(`/api/view-salary/` + id +`?page=${page}&total=${this.total}`)
                .then(({data}) => {(this.salaries = data.data, this.pageInfo = data)})
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
