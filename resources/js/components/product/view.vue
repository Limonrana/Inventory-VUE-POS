<template>
    <div class="product_view">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Product Details</h4>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product-Details</li>
                            </ol>
                        </nav>
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
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ product.product_name }}</h3>
                            <h6 class="card-subtitle">{{ product.sub_title }}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center"> <img :src="`/uploads/products/${product.photo}`" class="img-responsive"> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6">
                                    <h2 class="m-t-40">${{ product.selling_price }} <small class="text-success">({{ product.discount }}$ off)</small></h2>
                                    <button class="btn btn-dark btn-rounded m-r-5 mt-3" data-toggle="tooltip" title="" data-original-title="Add to cart"><i class="ti-shopping-cart"></i> </button>
                                    <button class="btn btn-primary btn-rounded mt-3"> Buy Now </button>
                                    <h3 class="box-title m-t-40">Key Highlights</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check text-success"></i> {{ product.cpu }}</li>
                                        <li><i class="fa fa-check text-success"></i> {{ product.display_size }}</li>
                                        <li><i class="fa fa-check text-success"></i> {{ product.ram }}/{{ product.rom }}</li>
                                    </ul>
                                    <h4 class="box-title m-t-40">Product description</h4>
                                    <p>{{ product.product_description }}</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="box-title m-t-40">General Info</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td width="390">Brand</td>
                                                <td> {{ product.brand }} </td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td> {{ product.category.name }} </td>
                                            </tr>
                                            <tr>
                                                <td>Supplier</td>
                                                <td> {{ product.supplier.name }} </td>
                                            </tr>
                                            <tr>
                                                <td>CPU/CPU</td>
                                                <td> {{ product.cpu }} </td>
                                            </tr>
                                            <tr>
                                                <td>Display Size/Type</td>
                                                <td> {{ product.display_size }} </td>
                                            </tr>
                                            <tr>
                                                <td>Color</td>
                                                <td> {{ product.color }} </td>
                                            </tr>
                                            <tr>
                                                <td>Ram</td>
                                                <td> {{ product.ram }} </td>
                                            </tr>
                                            <tr>
                                                <td>Rom</td>
                                                <td> {{ product.rom }} </td>
                                            </tr>
                                            <tr>
                                                <td>Product Code</td>
                                                <td> {{ product.product_code }} </td>
                                            </tr>
                                            <tr>
                                                <td>Root</td>
                                                <td> {{ product.root }} </td>
                                            </tr>
                                            <tr>
                                                <td>Buying Date</td>
                                                <td> {{ product.buying_date }} </td>
                                            </tr>
                                            <tr>
                                                <td>Buying Price</td>
                                                <td> ${{ product.buying_price }} </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td> {{ product.status }} </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
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
        name: "view",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            //product data
            let id = this.$route.params.id
            axios.get('/api/product/'+id)
                .then(({data}) => (this.product = data))
        },
        data() {
            return {
                product: {
                    product_name: null,
                    sub_title: null,
                    product_description: null,
                    product_code: null,
                    category_id: null,
                    supplier_id: null,
                    root: null,
                    brand: null,
                    buying_price: null,
                    selling_price: null,
                    discount: null,
                    buying_date: null,
                    product_quantity: null,
                    cpu: null,
                    color: null,
                    ram: null,
                    rom: null,
                    display_size: null,
                    photo: null,
                    status: null

                },
                categories: { },
                suppliers: { },
            }
        },
    }
</script>

<style scoped>

</style>
