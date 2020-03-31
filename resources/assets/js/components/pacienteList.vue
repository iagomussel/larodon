<template>
      <hi-table 
  :url="url"
  :novo_url="novo_url"
  :ver_url="ver_url"
  :filter_fields="filter_field"
  :headers="{'Ficha':'ficha','Avatar':'imagem','Nome':'nome','Dentista':'destista_nome','Sexo':'sexo','Data de Nascimento':'data_nasc'}"
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
            switch(field){
                case 'data_nasc':
                    var nasc = moment(value);
                    return nasc.format("DD/MM/Y")
                break;
                case 'imagem':
                    return '<img src=\''+value+'\' class="img-thumbnail img-fluid" width="64"/>'
                                
                break;
            }
            return value
        }
    },
    components:{
        'hi-table':TablesComponent
    }
}
</script>