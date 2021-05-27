class Notification {

    success() {
        new Noty({
            theme: 'nest',
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done!',
            timeout: 3000,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight'
            }
        }).show();
    }

    alert() {
        new Noty({
            theme: 'nest',
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure?',
            timeout: 3000,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight'
            }
        }).show();
    }

    danger() {
        new Noty({
            theme: 'nest',
            type: 'error',
            layout: 'topRight',
            text: 'Opps! Something is missing!',
            timeout: 3000,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight'
            }
        }).show();
    }

    warning() {
        new Noty({
            theme: 'nest',
            type: 'warning',
            layout: 'topRight',
            text: 'Best check your self, you\'re not looking too good!',
            timeout: 3000,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight'
            }
        }).show();
    }

    sweet_success() {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Great Job',
            text: 'You are successfully done!',
            showConfirmButton: false,
            timer: 3000
        })
    }

    sweet_image() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please upload image less then 1MB!',
            footer: 'You can\'t upload this image'
        })
    }
}

export default Notification = new Notification();
