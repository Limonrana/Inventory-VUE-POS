<template>
    <div class="employee">
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
                            <h4 class="card-title">Contact Emplyee list</h4>
                            <h6 class="card-subtitle"></h6>
                            <input type="text" class="form-control float-left m-t-10 mb-2" id="SearchData" placeholder="Search" v-model="SearchTerms">
                            <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right" @click="add_new">Add New</button>
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>NID</th>
                                        <th>Joining date</th>
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
                                        <td>{{ employee.nid }}</td>
                                        <td>{{ employee.join }}</td>
                                        <td>
                                            <router-link :to="{ name:'edit-employee', params: {id: employee.id} }" class="btn btn-info">Edit</router-link>
                                            <button @click="DeleteEmployee(employee.id)" class="btn btn-danger">Delete</button>
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
        name: "all",
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
                   return employee.name.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllEmployee(page=1) {
                axios.get(`/api/employee?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.employees = data.data, this.pageInfo = data)})
                    .catch()
            },
            add_new() {
                this.$router.push( {name: 'add-employee'} )
            },
            DeleteEmployee(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/employee/'+id)
                        .then(() => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name: 'all-employee'} )
                        })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        }
    }
</script>

<style scoped>
    #SearchData {
        width: 15%;
    }
</style>
