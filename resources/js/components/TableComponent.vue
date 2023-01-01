<template>
    <BootstrapTable
      :columns="columns"
      :data="data"
      :options="options"
    />
</template>

<script>
  import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.esm.js'

  export default {
    components: {
      BootstrapTable
    },
    data () {
      return {
        columns: [
          {
            title: 'Item ID',
            field: 'id'
          },
          {
            field: 'name',
            title: 'Item Name'
          },
          {
            field: 'price',
            title: 'Item Price'
          }
        ],
        data: [
          {
            id: 1,
            name: 'Item 1',
            price: '$1'
          }
        ],
        options: {
          search: true,
          showColumns: true
        }
      }
    }
  }
</script>
