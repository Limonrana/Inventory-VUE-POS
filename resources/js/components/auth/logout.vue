<template>

</template>

<script>
    export default {
        name: "logout",
        created() {
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            Toast.fire({
                icon: 'success',
                title: 'Signed out successfully'
            })
            this.$router.push({name: '/'})
        }
    }
</script>

<style scoped>

</style>
