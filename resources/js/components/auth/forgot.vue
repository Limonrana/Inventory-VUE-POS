<template>
    <div class="forget">
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <h3 class="db">INVENTORY POS</h3>
                        <p class="font-medium m-b-20">Recover Password</p>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" action="#">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control form-control-lg" type="text" required="" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control form-control-lg" type="text" required="" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <router-link to="/" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Back to Login?</router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">RESET</button>
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
        name: "forget"
    }
</script>

<style scoped>
    .forget {
        margin-left: -250px;
        margin-top: -64px;
    }
</style>
