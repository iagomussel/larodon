<template>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading"><h1 class="text-center datetime">
  
  </h1></div>
  <div class="panel-body">
  <div class="row">
   <div class="col " >
     Em atendimento
     <ul class="list-group" id="atendimento-acordeon" v-bind:key="consulta.id" v-for='(consulta,index) in status(consultas,"Em andamento")'>
     <li class="list-group-item" data-toggle="collapse" :data-target="'#atendimento-'+index"  data-parent="#atendimento-acordeon">
         <strong>{{consulta.horario}}</strong> - <strong>{{consulta.paciente}}</strong> com Dr. <strong>{{consulta.dentista}}</strong> 
     <div :id="'atendimento-'+index"  class="row collapse">
        <div class="btn-group">
            <div class="btn btn-sm btn-primary">Encerrar</div>
        </div>
     
     </div>
     </li>
     </ul>
   </div>
   <div class="col">
     Proximos
     <ul class="list-group list-group-flush" id="atendimento-acordeon" v-bind:key="consulta.id" v-for='(consulta,index) in status(consultas,"pendente")'>
     <li class="list-group-item " data-toggle="collapse" :data-target="'#atendimento-pendente-'+index"  data-parent="#atendimento-acordeon">
         <strong>{{consulta.horario}}</strong> - <strong>{{consulta.paciente}}</strong> com Dr. <strong>{{consulta.dentista}}</strong> 
     <div :id="'atendimento-pendente-'+index"  class="row collapse">
        <div class="btn-group">
            <div class="btn btn-sm btn-primary">Iniciar</div>
            <div class="btn btn-sm btn-default">Cancelar</div>
            <div class="btn btn-sm btn-default">Faltou</div>
        </div>
     
     </div>
     </li>
     </ul>
   </div>
  </div>  
  <div class="row">
    <a href="#" class="col">
      <span class="badge">{{consultas.length}}</span> Consultas
    </a>
    <a  href="#" class="col">
    <span class="badge">{{realizadas()}}</span> Realizadas
    </a> 
    <a  href="#" class="col">
      <span class="badge">{{ausentes()}}</span> Ausentes
    </a>
    <a  href="#" class="col">
      <span class="badge">{{canceladas()}}</span> Canceladas
    </a>
  </div></div>
</div>
</div>
</template>

<script>
          
function mask00(str){
	return ("00"+str).slice(-2);
}
function update_clock(){
	var d = new Date();
 $('.datetime').text(mask00(d.getDate())+"/"+mask00(d.getMonth()+1)+"/"+mask00(d.getFullYear())+" - "+mask00(d.getHours())+":"+mask00(d.getMinutes())+":"+mask00(d.getSeconds()))
       
setTimeout(update_clock,900)}

    export default {
        mounted() {
              console.log(1);
             this.$http.get('consultas.json').then(
              (res)=>res.json())
              .then(res=>{
                this.consultas=res; 
              },
              (error) => {
                console.log(error)
              }
            )
             update_clock();
            
        },
        props:['url'],
        data:function(){
            return {
              consultas:[]
              }
        },
        methods:{
            status:function(data,st){
                var ret = [];
                var d;
                for(d in data ){
                    if(data[d].status == st){
                        ret.push(data[d])
                    }
                }
                return ret;
            },
            realizadas(){
              var real = this.status(this.consultas,"Realizada");
              return real.length;
            },
            ausentes(){
              var real = this.status(this.consultas,"Ausente");
              return real.length;
            },
            canceladas(){
              var real = this.status(this.consultas,"Cancelada");
              return real.length;
            }
        }

    }
</script>