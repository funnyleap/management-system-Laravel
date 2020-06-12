<template>
  <router-link :to="{name: linkname}">
    <v-list-tile>
      <v-list-tile-action>
        <v-icon>{{ getRoute( linkname, 'icon' ) }}</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>{{ getRoute( linkname, 'name' )}}</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
  </router-link>
</template>

<script>
  export default {
    name: 'routerlink',
    props: {
      linkname: String,
    },

    methods: {
      getRoute(name, key) {
        for(var i=0 ; i<this.$router.options.routes.length; i++) {
          if (this.$router.options.routes[i].name == name ) {
            return this.$router.options.routes[i].meta[key]
          }
        }
      },
    },

  }
</script>

<style>
  a:hover {
    text-decoration: none;
  }
</style>