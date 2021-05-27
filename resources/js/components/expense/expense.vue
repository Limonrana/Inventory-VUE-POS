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
                            <h4 class="card-title">Expense list</h4>
                            <h6 class="card-subtitle"></h6>
                            <input type="text" class="form-control float-left m-t-10 mb-2" id="SearchData" placeholder="Search" v-model="SearchTerms">
                            <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right" @click="addModal=true">Add New</button>
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="expense in filterSearch" :key="expense.id">
                                        <td>{{ expense.id }}</td>
                                        <td>{{ expense.details }}</td>
                                        <td><span class="label label-success">BDT. {{ expense.amount }}</span> </td>
                                        <td><span class="label label-danger">{{ expense.date }}</span> </td>
                                        <td>
                                            <button class="btn btn-info" @click="showEditModel(expense)">Edit</button>
                                            <button @click="DeleteExpense(expense.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllExpense" v-if="pageInfo" />
                            </div>

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="addModal"
                                title="Add New Expense"
                                :mask-closable="false"
                                :closable="false"
                                >
                                <Input v-model="form.amount" type="number" placeholder="Enter expense amount..."/>
                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                <Divider dashed />
                                <Input v-model="form.details" maxlength="85" :rows="4" show-word-limit type="textarea" placeholder="Expense details..."/>
                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="expenseInsert">Publish</Button>
                                    <Button type="default" @click="addModal=false">Close</Button>
                                </div>
                            </Modal>
                            <!-- End Category Popup Model -->

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="editModal"
                                title="Edit Expense"
                                :mask-closable="false"
                                :closable="false"
                            >
                                <Input v-model="editForm.amount" type="number" placeholder="Edit expense name..."/>
                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                <Divider dashed />
                                <Input v-model="editForm.details" maxlength="85" :rows="4" show-word-limit type="textarea" placeholder="Edit expense details..."/>
                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="expensesEdit(editForm.id)">Update</Button>
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
            this.AllExpense()
        },
        data() {
            return {
                expenses: [],
                SearchTerms: '',
                form: {
                    details: null,
                    amount: null
                },
                editForm: {
                    details: null,
                    amount: null
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
                return this.expenses.filter(expense => {
                    return expense.date.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllExpense(page=1) {
                axios.get(`/api/expense?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.expenses = data.data, this.pageInfo = data)})
                    .catch()
            },
            expenseInsert() {
                axios.post('/api/expense', this.form)
                    .then(() => {
                        this.addModal= false
                        this.AllExpense()
                        this.form.details=''
                        this.form.amount=''
                        //Notification.sweet_success()
                        this.s('Expense Successfully Published')
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            //Edit Category Start
            showEditModel(expense) {
                let obj = {
                    id: expense.id,
                    details: expense.details,
                    amount: expense.amount
                }
                this.editForm = obj
                this.editModal=true
            },
            expensesEdit(id) {
                axios.patch('/api/expense/'+id, this.editForm)
                    .then(() => {
                        this.editModal= false
                        this.AllExpense()
                        this.form.name=''
                        //Notification.sweet_success()
                        this.s('Expense Successfully Updated')
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            //Delete Category Start
            DeleteExpense(id) {
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
                        axios.delete('/api/expense/'+id)
                            .then(() => {
                                this.expenses = this.expenses.filter(expense => {
                                    return expense.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push( {name: 'expense'} )
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
