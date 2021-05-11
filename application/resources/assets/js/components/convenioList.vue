<template>
      <hi-table 
  :url="url"
  :novo_url="novo_url"
  :ver_url="ver_url"
  :filter_fields="filter_field"
  :headers="{'ID':'id','Nome':'nome'}"
    >
  </hi-table>
</template>
<script>

import TablesComponent from './tables.vue';


export default{
    props:{
        'url':String,
        'novo_url':String,
        'ver_url':String,
    },
    methods:{
        filter_field:function(field,value){
           return value
        }
    },
    components:{
        'hi-table':TablesComponent
    }
}
</script>