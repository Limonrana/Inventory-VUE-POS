<template>
    <div class="allsalary">
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
                            <h4 class="card-title">All Month Salary list</h4>
                            <h6 class="card-subtitle"></h6>
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Month Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="salary in salaries" :key="salary.id">
                                        <td>##</td>
                                        <td>{{ salary.salary_month }}</td>
                                        <td>
                                            <router-link :to="{ name:'view-salary', params: {id: salary.salary_month} }" class="btn btn-info">View Salary Sheet</router-link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
        name: "allsalary",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.AllSalary()
        },
        data() {
            return {
                salaries: [],
                SearchTerms: ''
            }
        },
        methods: {
            AllSalary() {
                axios.get('/api/all-salary')
                    .then(({data}) => {(this.salaries = data)})
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
