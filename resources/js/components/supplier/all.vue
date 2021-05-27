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
                            <h4 class="card-title">Contact Supplier list</h4>
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
                                        <th>Logo</th>
                                        <th>Shop name</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="supplier in filterSearch" :key="supplier.id">
                                        <td>{{ supplier.id }}</td>
                                        <td>{{ supplier.name }}</td>
                                        <td>{{ supplier.email }}</td>
                                        <td>{{ supplier.phone }}</td>
                                        <td><img :src="supplier.photo" alt="user" width="40" class="rounded-circle" /></td>
                                        <td><span class="label label-success">{{ supplier.shop_name }}</span> </td>
                                        <td>{{ supplier.state }}</td>
                                        <td>{{ supplier.country }}</td>
                                        <td>
                                            <router-link :to="{ name:'edit-supplier', params: {id: supplier.id} }" class="btn btn-info">Edit</router-link>
                                            <button @click="DeleteSupplier(supplier.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllSupplier" v-if="pageInfo" />
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
            this.AllSupplier()
        },
        data() {
            return {
                suppliers: [],
                SearchTerms: '',
                total:10,
                pageInfo: null
            }
        },
        computed: {
            filterSearch() {
                return this.suppliers.filter(supplier => {
                   return supplier.name.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllSupplier(page=1) {
                axios.get(`/api/supplier?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.suppliers = data.data, this.pageInfo = data)})
                    .catch()
            },
            add_new() {
                this.$router.push( {name: 'add-supplier'} )
            },
            DeleteSupplier(id) {
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
                        axios.delete('/api/supplier/'+id)
                        .then(() => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name: 'all-supplier'} )
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
