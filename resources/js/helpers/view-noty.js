export default {
    data() {
        return {

        }
    },
    methods: {
        //iView UI Alert
        i(desc, title="Hey") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        s(desc, title="Great") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        w(desc, title="Opps!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        e(desc, title="Hey") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        },
        er(desc="Something Went Wrong! Please Try Again.", title="Opps!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        }
    }
}
