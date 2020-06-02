<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component. <br>
                        <br>
                        <button v-on:click="axiosLogout">logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            logout: String,
        },

        mounted() {
            console.log('ExampleComponent mounted.')
        },

        methods: {
            axiosLogout() {
                axios.post(this.logout)
                    .then(function (response) {
                        console.log(response)
                    }.bind(this))
                    .catch(function (error) {
                        console.log(error)
                        if (error.response) {
                            if (error.response.status) {
                                if (error.response.status == 401 || error.response.status == 419) {
                                    var parser = new URL(this.logout)
                                    location.href = parser.origin
                                }
                            }
                        }
                    }.bind(this))
            },
        },
    }

</script>
