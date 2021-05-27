<template>
    <div class="employee">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Products List <span> <button type="button" class="btn btn-sm btn-outline-info btn-rounded m-t-10 mb-2 ml-2" @click="add_new"><i class="fas fa-plus-circle"></i> Add New</button></span></h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <input type="text" class="form-control m-t-10 mb-2" id="SearchData" placeholder="Search With Product Code Only..." v-model="SearchTerms">
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid mt-3">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row el-element-overlay">
                <div class="col-lg-3 col-md-6" v-for="product in filterSearch" :key="product.id">
                    <div class="card">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1"> <img :src="`/uploads/products/${product.photo}`" alt="Product"/>
                                <div class="el-overlay">
                                    <ul class="list-style-none el-info">
                                        <li class="el-item"><router-link :to="{ name:'edit-product', params: {id: product.id} }" class="btn default btn-outline el-link" href="#"><i class="sl-icon-note"></i></router-link></li>
                                        <li class="el-item"><router-link :to="{ name:'view-product', params: {id: product.id} }" class="btn default btn-outline el-link" href="#"><i class="sl-icon-eye"></i></router-link></li>
                                        <li class="el-item"><button class="btn default btn-outline el-link" @click="DeleteProduct(product.id)"><i class="sl-icon-trash"></i></button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex no-block align-items-center">
                                <div class="m-l-15">
                                    <h4 class="m-b-0">{{ product.product_name }}</h4>
                                    <span class="text-muted">Product Code: {{ product.product_code }}</span>
                                </div>
                                <div class="ml-auto m-r-15">
                                    <button type="button" class="btn btn-dark btn-circle price_sell">${{ product.selling_price }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="AllProducts" v-if="pageInfo" />
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
</template>

<script>
    export default {
        name: "all",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                products: [],
                SearchTerms: '',
                total: 8,
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
            AllProducts(page=1) {
                axios.get(`/api/product?page=${page}&total=${this.total}`)
                    .then(({data}) => {(this.products = data.data, this.pageInfo = data)})
                    .catch()
            },
            add_new() {
                this.$router.push( {name: 'add-product'} )
            },
            DeleteProduct(id) {
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
                        axios.delete('/api/product/'+id)
                        .then(() => {
                            this.products = this.products.filter(product => {
                                return product.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push( {name: 'all-product'} )
                        })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
        mounted() {
            this.AllProducts()
        }
    }
</script>

<style scoped>
    #SearchData {
        width: 35%;
    }
</style>
