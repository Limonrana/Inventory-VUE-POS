<template>
    <div class="stock">
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
                            <h4 class="card-title">Product stock list</h4>
                            <h6 class="card-subtitle"></h6>
                            <input type="text" class="form-control float-left m-t-10 mb-2" id="SearchData" placeholder="Search With Product Code Only..." v-model="SearchTerms">
                            <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Product Code</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in filterSearch" :key="product.id">
                                        <td>{{ product.id }}</td>
                                        <td>{{ product.product_name }}</td>
                                        <td><span class="label label-danger">{{ product.product_code }}</span> </td>
                                        <td>{{ product.category.name }}</td>
                                        <td>{{ product.supplier.shop_name }}</td>
                                        <td>BDT. {{ product.buying_price }}</td>
                                        <td>BDT. {{ product.selling_price }}</td>
                                        <td><span class="label label-info">{{ product.product_quantity }} QTY</span></td>
                                        <td>
                                            <span class="label label-success" v-if="product.product_quantity >= 1">In Stock</span>
                                            <span class="label label-danger" v-else>Stock Out</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-info" @click="showEditModel(product)">Edit</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllProduct" v-if="pageInfo" />
                            </div>

                            <!-- Add Category Popup Model -->
                            <Modal
                                v-model="editModal"
                                title="Edit Product Stock"
                                :mask-closable="false"
                                :closable="false"
                            >
                                <label>Product Name</label>
                                <Input v-model="editForm.product_name" disabled placeholder="Enter product name..."/>
                                <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                <br>
                                <label>Product Code</label>
                                <Input v-model="editForm.product_code" disabled placeholder="Enter product code..."/>
                                <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                <br>
                                <label>Product Quantity</label>
                                <Input v-model="editForm.product_quantity" placeholder="Edit product qty..."/>
                                <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                <div slot="footer">
                                    <Button type="primary" @click="productEdit(editForm.id)">Update</Button>
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
        name: "stock",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            this.AllProduct()
        },
        data() {
            return {
                products: [],
                SearchTerms: '',
                form: {
                    name: null
                },
                editForm: {
                    product_name: null,
                    product_quantity: null,
                    product_code: null

                },
                errors: { },
                editModal: false,
                total: 10,
                pageInfo: null
            }
        },
        computed: {
            filterSearch() {
                return this.products.filter(product => {
                    return product.product_code.match(this.SearchTerms)
                })
            }
        },
        methods: {
            AllProduct(page=1) {
                axios.get(`/api/product?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.products = data.data, this.pageInfo = data)})
                    .catch()
            },

            //Edit Category Start
            showEditModel(product) {
                let obj = {
                    id: product.id,
                    product_name: product.product_name,
                    product_code: product.product_code,
                    product_quantity: product.product_quantity
                }
                this.editForm = obj
                this.editModal=true
            },
            productEdit(id) {
                axios.post('/api/product/stock-update/'+id, this.editForm)
                    .then(() => {
                        this.editModal= false
                        this.AllProduct()
                        this.form.product_name=''
                        this.form.product_code=''
                        this.form.product_quantity=''
                        //Notification.sweet_success()
                        this.s('Product Quantity Successfully Updated')
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
    span.label.label-info, .label-danger, .label-success {
        font-size: 12px;
        font-weight: 600;
    }
</style>
