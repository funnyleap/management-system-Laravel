<template>
  <v-flex>
    <v-card xs12 class="m-3 px-3">

      <v-card-title class="title">
        <v-icon class="pr-2">{{ $route.meta.icon }}</v-icon> {{ $route.meta.name }} {{ /* 社員管理 */ }}
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>

      <v-data-table
        :headers="headers"
        :items="tabledata"
        :pagination.sync="pagination"
        :rows-per-page-items='[10,25,50,{"text":"All","value":-1}]'
        :loading="loading"
        :search="search"
        class="elevation-0 p-1"
      >
        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>

        <template slot="items" slot-scope="props">
          <tr>
            <td class="text-xs-center" xs1>{{ (props.index + 1) + (pagination.page - 1) * pagination.rowsPerPage }}</td>
            <template v-for="n in (headers.length - 1)">
              <td :class="'text-xs-' + headers[n].align" style="white-space: nowrap;" v-text="props.item[headers[n].value]"></td>
            </template>
          </tr>
        </template>

      </v-data-table>
    </v-card>
  </v-flex>
</template>

<script>
  export default {
    name: 'UserComponent',

    props: {
      logout: String,
    },

    data: () => ({
      loading: true,
      search: '',
      pagination: { sortBy: 'name', descending: false, },

      tabledata: [],
      headers: [
        { align: 'center', sortable: false, text: 'No',       },
        { align: 'left',   sortable: true,  text: '社員ID',   value: 'login_id' },
        { align: 'left',   sortable: true,  text: '氏名',     value: 'name' },
        { align: 'center', sortable: true,  text: '権限',     value: 'role' },
      ],
    }),

    created() {
      console.log('User Component created.')
      this.initialize()
    },

    methods: {
      initialize: function() {
        this.getUsers()
      },

      getUsers() {
        this.loading = true
        axios.post('/api/admin/user')

        .then( function (response) {
          this.loading = false
          console.log(response)
          if (response.data.users) {
            this.tabledata = response.data.users
            this.setRole()
          }
        }.bind(this))

        .catch(function (error) {
          this.loading = false
          console.log(error)
          if (error.response) {
            if (error.response.status == 401 || error.response.status == 419) {
              this.$emit('axios-logout')
            }
          }
        }.bind(this))
      },

      setRole() {
        for (var i=0; i<this.tabledata.length; i++) {
          if (this.tabledata[i].role == 1) { this.tabledata[i].role = '開発者'  }
          if (this.tabledata[i].role == 2) { this.tabledata[i].role = '管理者'  }
          if (this.tabledata[i].role == 3) { this.tabledata[i].role = 'ユーザ'  }
        }
      },
    },
  }
</script>