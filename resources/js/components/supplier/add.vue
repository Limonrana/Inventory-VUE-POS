<template>
    <div class="addnew">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-lg-12 m-auto">
                    <form @submit.prevent="supplierInsert" enctype="multipart/form-data">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add New Supplier</h4>
                                <h6 class="card-subtitle">Please fill-up all data from below and publish and generate new supplier.</h6>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="control-label col-form-label">Supplier Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Supplier Name here" v-model="form.name">
                                        </div>
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basic-addon11" class="control-label col-form-label">Supplier Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" placeholder="Supplier Email here" v-model="form.email">
                                            </div>
                                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basic-addon11" class="control-label col-form-label">Supplier Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="tel" class="form-control" placeholder="Supplier Phone here" v-model="form.phone">
                                            </div>
                                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Supplier Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-map"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Supplier Address here" v-model="form.address">
                                            </div>
                                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Supplier Country</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-flag"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Supplier Country here" v-model="form.country">
                                            </div>
                                            <small class="text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Supplier City</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-building"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Supplier City here" v-model="form.city">
                                            </div>
                                            <small class="text-danger" v-if="errors.city">{{ errors.City[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Supplier State</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Supplier State here" v-model="form.state">
                                            </div>
                                            <small class="text-danger" v-if="errors.state">{{ errors.state[0] }}</small>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Supplier Shop Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Supplier Shop Name here" v-model="form.shop_name">
                                            </div>
                                            <small class="text-danger" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                        <div class="row">
                        <div class="col-sm-12 col-lg-10">
                            <div class="card" style="height: 165px">
                                <div class="card-body">
                                    <h4 class="card-title">Image Upload</h4>
                                    <div class="fallback">
                                        <input name="file" type="file" @change="onChangeFile"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <div class="card">
                                <div class="card-body" style="text-align: center;">
                                    <img :src="form.photo" width="150px" height="120px">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="action-form">
                            <div class="form-group m-b-0 mt-3 text-right">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Publish</button>
                                <a href="#" class="btn btn-dark waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</template>

<script>
    export default {
        name: "add",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                form: {
                    email: null,
                    name: null,
                    phone: null,
                    address: null,
                    shop_name: null,
                    city: null,
                    state: null,
                    country: null,
                    photo: null

                },
                errors: { }
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
            supplierInsert() {
                axios.post('/api/supplier', this.form)
                    .then(() => {
                        this.$router.push({name: 'all-supplier'})
                        Notification.sweet_success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
