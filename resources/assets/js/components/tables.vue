<template>
<div >
    <div >
        <div class="input-group w-100">
            <div class="input-group-prepend">
                <a class="input-group-text" :href="novo_url">Novo</a>
            </div>
            <input type="text" v-model="searchterm" class="form-control" placeholder="Pesquisar"/>
        </div>
        <table class="table table-borded table-hover table-sm">
            <thead>
            <tr >
                <th v-for="header,col,key in headers">{{col}}</th>
            </tr>
            </thead> 
            <tbody>
                <tr v-for="row in dados.data" class="context_menu_row" :id="row.id" v-on:dblclick="get_show_url(row.id)">
                <td v-for="header in headers"  v-html="filter_fields(header,row[header])"></td>
                </tr>
            </tbody>           
        </table>
        <div class="row overflow-auto">
            <div class='col'>
                {{dados.total}} resultados.
            </div>
            <div class='col'>
                <b-pagination-nav v-on:input="change_page"  :link-gen="function(){return '#'}" v-bind:number-of-pages="dados.last_page"  align="center" use-router></b-pagination-nav>
            </div>
            <div class='col'></div>
        </div>
    
    </div>
    <div class="modal" v-html="modal_content">
    </div>
 </div>
</template>

<script>    
    export default {
        mounted() {
            this.change_page(1);
        },
        props:{
            'url':String,
            'headers':Object,
            'novo_url':String,
            'ver_url':String,
            'filter_fields':Function
        },
        data(){
            return {
                modal:false,
                modal_content:"",
                searchterm:"",
                dados:{},
                } 
        },
        methods: {
            get_show_url(id){
                document.location = this.ver_url.replace('__id__',id);
            },
            change_page(pageNum){
                this.$http.get(this.url+"/"+this.searchterm+this.linkGen(pageNum))
                .then(res=>res.json())
                .then(res=>{
                    this.dados = res;
                })
            },
            linkGen(pageNum) {
                return pageNum === 1 ? '?' : `?page=${pageNum}`
            }
        },
        watch:{
            searchterm:function(search){
                this.change_page(this.dados.current_page);
            }
        }



    }
</script>
<style>


</style>
