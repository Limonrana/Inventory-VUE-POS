<template>
    <div class="edit">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-lg-12 m-auto">
                    <form @submit.prevent="employeeUpdate">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Employee</h4>
                                <h6 class="card-subtitle">Please fill-up all data from below and update existing employee.</h6>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="control-label col-form-label">Employee Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Employee Name here" v-model="form.name">
                                        </div>
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basic-addon11" class="control-label col-form-label">Employee Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" placeholder="Employee Email here" v-model="form.email">
                                            </div>
                                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basic-addon11" class="control-label col-form-label">Employee Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="tel" class="form-control" placeholder="Employee Phone here" v-model="form.phone">
                                            </div>
                                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Employee Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-map"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Employee Address here" v-model="form.address">
                                            </div>
                                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Employee NID</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Employee NID Number here" v-model="form.nid">
                                            </div>
                                            <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Joining Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                                </div>
                                                <input type="date" class="form-control" v-model="form.join">
                                            </div>
                                            <small class="text-danger" v-if="errors.join">{{ errors.join[0] }}</small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail3" class="control-label col-form-label">Salary</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Employee Salary here" v-model="form.salary">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
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
                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                <router-link :to="{ name: 'all-employee' }" class="btn btn-dark waves-effect waves-light">Cancel</router-link>
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
        name: "edit",
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
                    nid: null,
                    join: null,
                    salary: null,
                    photo: null,
                    newphoto: null

                },
                errors: { }
            }
        },
        mounted() {
            let id = this.$route.params.id
            axios.get('/api/employee/'+id)
            .then(({data}) => (this.form = data))
            .catch(console.log("error"))
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
                        this.form.newphoto = event.target.result
                        //console.log(event.target.result)
                    }
                    reader.readAsDataURL(file);
                }
            },
            employeeUpdate() {
                let id = this.$route.params.id
                axios.patch('/api/employee/'+id, this.form)
                    .then(() => {
                        this.$router.push({name: 'all-employee'})
                        Notification.sweet_success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>

</style>
