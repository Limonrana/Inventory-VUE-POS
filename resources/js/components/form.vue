<template>
    <div class="addnew">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <div class="card">
                        <form>
                            <div class="card-body">
                                <h4 class="card-title">Add New Employee</h4>
                                <h6 class="card-subtitle">Please fill-up all data from below and publish and generate new employee.</h6>
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
                                            <input type="text" class="form-control" placeholder="Employee Name here" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="basic-addon11" class="control-label col-form-label">Project Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon11"><i class="fas fa-briefcase"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Project Name here" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Employee Details</h4>
                                                <div class="summernote">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon13"><i class="fas fa-comments"></i></span>
                                                </div>
                                                <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail3" class="control-label col-form-label">Rate Per Hour</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">Start Time</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon14"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="time" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label col-form-label">End Time</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon18"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="time" class="form-control" aria-label="Username">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Image Upload</h4>
                            <form action="#" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
                            <div class="action-form">
                                <div class="form-group m-b-0 mt-3 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</template>

<script>
    export default {
        name: "form"
    }
</script>

<style scoped>

</style>
