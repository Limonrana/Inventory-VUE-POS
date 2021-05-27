<template>
    <div class="login">
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <h3 class="db">INVENTORY POS</h3>
                        <p class="font-medium m-b-20">Sign In to Admin</p>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" @submit.prevent="login">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email Address" v-model="form.email" aria-label="Email Address" aria-describedby="basic-addon1">
                                </div>
                                <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                                <div class="input-group mt-3 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" v-model="form.password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                                <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                            <router-link to="/forgot-password" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                        <div class="social">
                                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Don't have an account? <router-link to="/register" class="text-info m-l-5"><b>Sign Up</b></router-link>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
</template>

<script>
    export default {
        name: "login",
        created() {
            if (User.loggedIn()) {
                this.$router.push({name: 'dashboard'})
            }
        },
        data() {
            return {
                form: {
                    email: null,
                    password: null
                },
                errors: { },
            }
        },
        methods: {
            login() {
                axios.post('/api/auth/login', this.form)
                    .then(res => {
                        User.responseAfterLogin(res)
                        Toast.fire({
                            icon: 'success',
                            title: 'Signed in successfully'
                        })
                        this.$router.push({name: 'dashboard'})
                    })
                    .catch(
                        Toast.fire({
                            icon: 'warning',
                            title: 'Opps! Something Wrong, Try again!'
                        })
                    )
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>

<style scoped>
    .login {
        margin-left: -250px;
        margin-top: -64px;
    }
</style>
