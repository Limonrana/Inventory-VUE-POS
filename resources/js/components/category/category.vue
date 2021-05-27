<template>
    <div class="category">
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
                            <h4 class="card-title">Product Category list</h4>
                            <h6 class="card-subtitle"></h6>
                            <input type="text" class="form-control float-left m-t-10 mb-2" id="SearchData" placeholder="Search" v-model="SearchTerms">
                            <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right" @click="addModal=true">Add New</button>
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="category in filterSearch" :key="category.id">
                                        <td>{{ category.id }}</td>
                                        <td>{{ category.name }}</td>
                                        <td><span class="label label-danger">{{ category.slug }}</span> </td>
                                        <td><span class="label label-success">{{ category.created_at }}</span> </td>
                                        <td>
                                            <button class="btn btn-info" @click="showEditModel(category)">Edit</button>
                                            <button @click="DeleteSupplier(category.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllCategory" v-if="pageInfo" />
                            </div>

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="addModal"
                                title="Add New Product Category"
                                :mask-closable="false"
                                :closable="false"
                                >
                                <Input v-model="form.name" placeholder="Enter category name..."/>
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="categoryInsert">Publish</Button>
                                    <Button type="default" @click="addModal=false">Close</Button>
                                </div>
                            </Modal>
                            <!-- End Category Popup Model -->

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="editModal"
                                title="Edit Product Category"
                                :mask-closable="false"
                                :closable="false"
                            >
                                <Input v-model="editForm.name" placeholder="Edit category name..."/>
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="categoryEdit(editForm.id)">Update</Button>
                                    <Button type="default" @click="editModal=false">Close</Button>
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
        name: "category",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.AllCategory()
        },
        data() {
            return {
                categories: [],
                SearchTerms: '',
                form: {
                    name: null
                },
                editForm: {
                    name: null
                },
                errors: { },
                addModal: false,
                editModal: false,
                total: 10,
                pageInfo: null
            }
        },
        computed: {
            filterSearch() {
                return this.categories.filter(category => {
                    return category.name.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllCategory(page=1) {
                axios.get(`/api/category?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.categories = data.data, this.pageInfo = data)})
                    .catch()
            },
            categoryInsert() {
                axios.post('/api/category', this.form)
                    .then(() => {
                        this.addModal= false
                        this.AllCategory()
                        this.form.name=''
                        //Notification.sweet_success()
                        this.s('Category Successfully Published')
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            //Edit Category Start
            showEditModel(category) {
                let obj = {
                    id: category.id,
                    name: category.name
                }
                this.editForm = obj
                this.editModal=true
            },
            categoryEdit(id) {
                axios.patch('/api/category/'+id, this.editForm)
                    .then(() => {
                        this.editModal= false
                        this.AllCategory()
                        this.form.name=''
                        //Notification.sweet_success()
                        this.s('Category Successfully Updated')
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            //Delete Category Start
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
                        axios.delete('/api/category/'+id)
                            .then(() => {
                                this.categories = this.categories.filter(category => {
                                    return category.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push( {name: 'all-category'} )
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
