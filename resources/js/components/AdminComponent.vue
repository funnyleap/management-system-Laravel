<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">Admin Component</div>

          <div class="card-body">
            I'm an admin component.
            <div class="roledetail">
              ID: {{ id }}<br>
              Name: {{ name }}<br>
              Role: {{ role }}<br>
            </div>
            <button v-on:click="axiosLogout">logout</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.roledetail {
  color: blue;
  font-size: 4vw;
}
</style>

<script>
export default {
  props: {
    id: String,
    name: String,
    role: String,
    logout: String,
  },

  mounted() {
    console.log('AdminComponent mounted.')
    console.log('name: '+ this.name)
  },

  methods: {
    axiosLogout() {
      axios.post(this.logout)
      .then( function (response) {
        console.log(response)
      }.bind(this))

      .catch(function (error) {
        console.log(error)
        if (error.response) {
          if (error.response.status) {
            if (error.response.status == 401 || error.response.status == 419) {
              var parser = new URL(this.logout)
              location.href=parser.origin
            }
          }
        }
      }.bind(this))
    },
  },
}
</script>