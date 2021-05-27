<template>
    <div class="addnew">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add New Product</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">Add New</li>
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
                            <form @submit.prevent="productInsert">
                                <div class="form-body">
                                    <h5 class="card-title">About Product</h5>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered td-padding">
                                            <tbody>
                                            <tr>
                                                <td width="80%">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Product Name</label>
                                                                <input type="text" id="firstName" class="form-control" placeholder="Enter Product Name..." v-model="form.product_name">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Sub Title</label>
                                                                <input type="text" id="lastName" class="form-control" placeholder="Enter Product Sub Title..." v-model="form.sub_title">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.join">{{ errors.join[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Selling Price</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon1"><i class="ti-money"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="price" aria-label="price" aria-describedby="basic-addon1" v-model="form.selling_price">
                                                                </div>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Discount</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon2"><i class="ti-cut"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" placeholder="Discount..." aria-label="Discount" aria-describedby="basic-addon2" v-model="form.discount">
                                                                </div>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.discount">{{ errors.discount[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Buying Price</label>
                                                                <input type="text" class="form-control" placeholder="Enter Product Buying Price..." v-model="form.buying_price">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Buying Date</label>
                                                                <DatePicker type="date" placeholder="Select Buying Date" style="width: 100%" v-model="form.buying_date"></DatePicker>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Code</label>
                                                                <input type="text" class="form-control" placeholder="Enter Product Code..." v-model="form.product_code">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Root</label>
                                                                <input type="text" class="form-control" placeholder="Enter Product Root..." v-model="form.root">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Category</label>
                                                                <select class="form-control" placeholder="Choose a Category" tabindex="1" v-model="form.category_id">
                                                                    <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                                                                </select>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Supplier</label>
                                                                <select class="form-control" placeholder="Choose a Supplier" tabindex="1" v-model="form.supplier_id">
                                                                    <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                                                                </select>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Product Quantity</label>
                                                                <input type="text" class="form-control" v-model="form.product_quantity">
                                                            </div>
                                                            <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <h5 class="card-title m-t-40">Product Description</h5>
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="4" v-model="form.product_description"></textarea>
                                                            </div>
                                                            <small class="text-danger" v-if="errors.product_description">{{ errors.product_description[0] }}</small>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                </td>
                                                <td width="20%">
                                                    <div class="col-md-12">
                                                        <h5 class="card-title m-t-20">Status</h5>
                                                        <RadioGroup v-model="form.status">
                                                            <Radio label="Publish" value="1" border></Radio>
                                                            <Radio label="Draft" value="2" border></Radio>
                                                        </RadioGroup>
                                                        <small class="text-danger" v-if="errors.join">{{ errors.join[0] }}</small>
                                                    </div>
                                                    <div class="col-md-12 mt-5">
                                                        <h5 class="card-title m-t-20">Product Image</h5>
                                                        <Upload
                                                            ref="upload"
                                                            :headers="{'X-Requested-With' : 'XMLHttpRequest'}"
                                                            :format="['jpg','jpeg','png', 'bmp']"
                                                            :on-error="handleError"
                                                            :on-success="handleSuccess"
                                                            :max-size="2048"
                                                            :on-format-error="handleFormatError"
                                                            :on-exceeded-size="handleMaxSize"
                                                            type="drag"
                                                            action="/api/product/upload">
                                                            <div style="padding: 20px 0">
                                                                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                                                <p>Click or drag files here to upload</p>
                                                            </div>
                                                        </Upload>
                                                        <div class="el-element-overlay" v-if="form.photo">
                                                            <div class="el-card-item">
                                                                <div class="el-card-avatar el-overlay-1"> <img :src="`/uploads/products/${form.photo}`"/>
                                                                    <div class="el-overlay">
                                                                        <ul class="list-style-none el-info">
                                                                            <li class="el-item"><a class="btn default btn-outline el-link" @click="deleteImage"><i class="sl-icon-trash"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions m-t-40 text-right">
                                                        <button type="submit" class="btn btn-info btn-md"> <i class="fa fa-check"></i> Publish</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-title m-t-40">GENERAL INFO</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered td-padding">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="Brand" v-model="form.brand">
                                                            <small class="text-danger" v-if="errors.brand">{{ errors.brand[0] }}</small>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="CPU/GPU" v-model="form.cpu">
                                                            <small class="text-danger" v-if="errors.cpu">{{ errors.cpu[0] }}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="RAM" v-model="form.ram">
                                                            <small class="text-danger" v-if="errors.ram">{{ errors.ram[0] }}</small>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="ROM" v-model="form.rom">
                                                            <small class="text-danger" v-if="errors.rom">{{ errors.rom[0] }}</small>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="Color" v-model="form.color">
                                                            <small class="text-danger" v-if="errors.color">{{ errors.color[0] }}</small>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" placeholder="Display Size" v-model="form.display_size">
                                                            <small class="text-danger" v-if="errors.display_size">{{ errors.display_size[0] }}</small>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        name: "add",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
            axios.get('/api/getcategory')
            .then(({data}) => (this.categories = data))

            axios.get('/api/getsupplier')
            .then(({data}) => (this.suppliers = data))
        },
        data() {
            return {
                form: {
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
                errors: { },
                categories: { },
                suppliers: { }
            }
        },
        methods: {
            onChangeFile(event) {
                let file = event.target.files[0];
                if (file.size > 1048770) {
                    Notification.sweet_image();
                }
                else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.photo = event.target.result
                    }
                    reader.readAsDataURL(file);
                }
            },
            productInsert() {
                axios.post('/api/product', this.form)
                    .then(() => {
                        this.$router.push({name: 'all-product'})
                        this.s('Product Successfully Published')
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
            handleSuccess (res, file) {
                this.form.photo = res
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleError (file) {
                this.$Notice.warning({
                    title: 'Opps! Something went wrong?',
                    desc: 'Please Try Again'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
            deleteImage() {
                let image = this.form.photo
                this.form.photo = ''
                this.$refs.upload.clearFiles()
                axios.post('/api/product/image/delete', {imageName: image})
                    .then(() => {
                        this.s('Image Successfully Removed')
                    })
                    .catch(error => this.form.photo = image)
            }
        }
    }
</script>

<style scoped>

</style>
