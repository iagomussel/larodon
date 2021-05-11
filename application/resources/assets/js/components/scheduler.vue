<template>
<div class="row">

    <div class="col-12">
        <div class="container">
            <div class="calendar-bar">
                <div class="input-group ">
                    <div class="input-group-preppend">
                        <button class="btn btn-outline-secondary" v-on:click="verdia(-1)" id="basic-addon2">Anterior</button>
                    </div>
                    <span type="text" class="form-control text-center">{{dia.format("DD/MM/YYYY")}}</span>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" v-on:click="verdia(1)" id="basic-addon2">Proximo</button>
                    </div>
                </div>
            </div>
            <div class="row" v-bind:style="{ height: (horariosList().length*25)+'px' }">
                <div class="col-1 p-0">
                    <div class="text-center section_name">
                        <span>#</span>
                    </div>
                    <div class="events-container h-100">
                        <div class="events-container-overlay w-100 text-center" v-for="horario in horariosList()" v-bind:key="horario" v-bind:style="{ top: position_horario(horario)+'%',height: tamanho_espaco(horario)+'%' }">{{horario}}</div>
                        <div class="events-container-overlay horarios_row text-center linha" v-bind:style="barra_hora">{{hora_atual}}</div>
                    </div>
                </div>
                <div v-bind:key="section.id" v-for="section in dados.agendamentos" class="col p-0">
                    <div class="text-center section_name"><span>{{section.nome}}</span></div>

                    <div class=" m-0 events-container h-100">
                        <div class="events-container-overlay cell w-100" v-for="horario in horariosList()" v-bind:key="horario" v-bind:style="{ top: position_horario(horario)+'%',height: tamanho_espaco(horario)+'%' }" v-on:dblclick="agendar(section.id,horario)"></div>
                        <div class="events-container-overlay evento" v-on:dblclick="ver_agendamento(evento)" v-for="evento in section.eventos" v-bind:key="evento.id" v-bind:style="{ top: position_horario(evento.horario)+'%',height: tamanho_horario(evento.horario,evento.horario_termino)+'%' }">
                            <slot>
                                <div class="tool-container">
                                    <div class="d-flex justify-content-between align-items-center pl-2">
                                        <small class="paciente_nome">{{evento.paciente_nome}}</small>
                                    
                                            <span class="horario">{{evento.horario}} - {{evento.horario_termino}}</span>
                                     
                                    </div>
                                </div>
                            </slot>
                        </div>
                        <div class="events-container-overlay linha" v-bind:style="barra_hora"></div>
                    </div>
                </div>
            </div>


            
        </div>
    </div>
            <div class="modal" id="modal_form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_form_content">Agendar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Agendamento para <b>{{formulario.dia}}</b> às <b>{{formulario.hora}}</b></p>
                            <input id="dia" v-model="formulario.dia" name="dia" type="hidden">
                            <input id="horario" v-model="formulario.hora" name="horario" type="hidden">
                            <input id="dentista" v-model="formulario.dentista" name="dentista" type="hidden">

                            <div class="form-group">
                                <label for="Paciente">Paciente</label>
                                <select style="width:100%" v-select2 v-model="formulario.paciente_nome" id="Paciente" name="Paciente" class="paciente_select form-control">
                                    <option disabled=disabled selected>Selecione...</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input v-model="formulario.paciente_telefone" id="telefone" name="telefone" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="procedimento">Procedimento</label>
                                <select v-model="formulario.procedimento" v-select2 id="procedimento" name="procedimento" class="procedimentos_select form-control">
                                    ...
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                <textarea id="observacao" name="observacao" cols="40" rows="5" class="form-control" v-model="formulario.obs"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="button" class="btn btn-primary" v-on:click="create_scheduler_entry">Agendar</button>

                        </div>

                    </div>
                </div>
            </div>
</div>
</template>

<script>
function init_pacientes_select() {
  $(()=>{
    console.log("init");
    $(".paciente_select").select2( {
        tags: true ,
        ajax: {
            
            url: function (params) {
                return 'api/pacientes/' + (params.term ? params.term : "");
            },
            dataType: 'json',
            processResults: function (data) {
                data.page = data.page || 1;
                return {
                    results: data.data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nome
                        };
                    }),
                    pagination: {
                        more: data.pagination
                    }
                }
            },
            data: function (params) {
                return {
                    page: params.page || 1
                };
            },
        },
        theme: "bootstrap"

    })
  }) 
}

function init_procedimentos_select() {
    $(".procedimentos_select").select2({
        
        tags:true,        ajax: {
            url: function (params) {
                return 'api/procedimentos/' + (params.term ? params.term : "");
            },
            dataType: 'json',
            processResults: function (data) {
                data.page = data.page || 1;
                return {
                    results: data.data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nome
                        };
                    }),
                    pagination: {
                        more: data.pagination
                    }
                }
            },
            data: function (params) {
                return {
                    page: params.page || 1
                };
            },
        },
        theme: "bootstrap"

    })
}
export default {
    mounted() {
        this.verdia(0)
        this.get_barra_horario();
        init_pacientes_select();
        init_procedimentos_select();
    },
    props: {
        horario_inicio: {
            default: "08:00"
        },
        horario_final: {
            default: "18:00"
        },
        intervalo: {
            default: 30
        },
        url: {
            default: "#"
        },

        url_create: {
            default: "#"
        },
        pacientes_url: {
            default: "#"
        }
    },
    data() {
        return {
            barra_hora: {
                top: 0
            },
            hora_atual: "",
            dia: new moment(),
            formulario: {
                dentista: 0,
                dia: 0,
                hora: 0,
                paciente_nome: "",
                paciente_telefone: "",
                procedimento: 0,
                obs: ""
            },
            agendamento:{
                paciente_nome:"",

            },
            modal:{
                page:""
            },
            dados: {}

        };
    },
    methods: {
        verdia(desloc) {
            this.dia.add(desloc, 'Days');
            this.get_data(this.dia.format("DD_MM_YYYY"));
        },
        ver_agendamento(evento){
            console.log(evento);
        },
        agendar(section, horario) {
            this.formulario.dentista = section;
            this.formulario.hora = horario;
            this.formulario.dia = this.dia.format("DD/MM/YYYY");
            this.formulario.paciente_nome = "";
            this.formulario.paciente_telefone = "";
            this.formulario.obs = "";

            $("#modal_form").modal();
            this.modal.page="agendar";
        },
        get_data(dia) {

            this.$http.get(this.url + "/" + dia)
                .then(res => res.json())
                .then(res => {
                    this.dados = res;
                })
        },

        horariosList: function () {

            var horarios = [];
            var v_inicial = moment(this.horario_inicio, "H:m");
            var v_final = moment(this.horario_final, "H:m");
            var v_intervalo = this.intervalo;

            while (v_inicial < v_final) {
                horarios.push(v_inicial.format("HH:mm"));
                v_inicial.add(v_intervalo, "Minutes");
            }
            return horarios;
        },
        position_horario(evento) {
            //obter valores
            var v_inicial = moment(this.horario_inicio, "H:m");
            var v_final = moment(this.horario_final, "H:m");
            var v_evento = moment(evento, "H:m");
            //calcular porcentagem para saber a altura do evento em relação ao quadro
            return this.get_porcent_horario(v_inicial, v_final, v_evento);
        },
        tamanho_horario(inicio, fim) {
            //obter valores
            var v_inicial = moment(this.horario_inicio, "H:m");
            var v_final = moment(this.horario_final, "H:m");
            var v_inicio_ev = moment(inicio, "H:m");
            var v_fim = moment(fim, "H:m");
            var dif_evento = v_fim.diff(v_inicio_ev, "seconds");

            var v_tamanho_ev = moment(this.horario_inicio, "H:m").add(dif_evento, "seconds");
            //calcular porcentagem para saber a altura do evento em relação ao quadro
            return this.get_porcent_horario(v_inicial, v_final, v_tamanho_ev);
        },
        tamanho_espaco(inicio){
            var v_inicio = moment(inicio, "H:m");
            var v_intervalo = this.intervalo;
            var v_fim = v_inicio.add(v_intervalo, "Minutes");
            var fim = v_fim.format("H:m");
            return this.tamanho_horario(inicio,fim);
        },
        get_porcent_horario(inicio, fim, current) {
            //totas de minutos no dia
            
            var diff_total = inicio.diff(fim, "seconds");   
            var diff_evento = inicio.diff(current, "seconds");
            var percent = (diff_evento / diff_total) * 100;
            return percent < 100 ? percent : 100;
        },
        get_barra_horario() {
            var v_inicial = moment(this.horario_inicio, "H:m");
            var v_final = moment(this.horario_final, "H:m");
            var v_evento = moment();
            this.hora_atual = v_evento.format("HH:mm:ss");
            if (v_inicial > v_evento || v_final < v_evento) {
                this.barra_hora.display = 'none'
            } else {
                this.barra_hora.display = 'block'
            }
            this.barra_hora.top =
                this.get_porcent_horario(v_inicial, v_final, v_evento) + "%";
            var self = this;
            //calcular porcentagem para saber a altura do evento em relação ao quadro
            setTimeout(function () {
                self.get_barra_horario();
            }, 1000);
        },
        create_scheduler_entry() {
            var self = this;
            this.$http.post(this.url_create, this.formulario)
                .then((res) => {
                    console.log(res);
                    $("#modal_form").modal("hide");
                    self.verdia(0);
                })

        }
    }
};
</script>

<style>
.section_name{

    overflow:hidden;
    font-size:14px;
    font-weigth:600;
    height:50px;
    vertical-align: middle;
    outline:black thin solid;
    
    
}
.section_name span{

  line-height: 1.5;
  display: inline-block;
  vertical-align: middle;
}

.events-container {
    position: relative;

}

.events-container .cell {
    border-top:thin solid black;
    background-color: white;
    box-shadow: -3px 0px 0px 0px rgba(0,0,0,0.34) inset;
-webkit-box-shadow: -3px 0px 0px 0px rgba(0,0,0,0.34) inset;
-moz-box-shadow: -3px 0px 0px 0px rgba(0,0,0,0.34) inset;
    height: 40px;
     -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
    
}

.events-container .cell:hover {
    background-color: rgb(176, 211, 241);
}

.bg_traced {
    background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAD6CAYAAABgQC1TAAAAGklEQVQ4jWNgGAWjgPbAwcHhP1ZiFIwCmgIAOzwIvNFbSNwAAAAASUVORK5CYII="
        );
    background-repeat: repeat-y;
    background-size: 100% 40px;
}

.events-container-overlay {
    position: absolute;
    z-index: 2;
    
    border-left:2px groove #0a0;
     -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
}

.evento {
    background-color: #abe0ae;
    border: thin solid #fff;
    width: 98%;
    min-height: 25px;
    top: 0;
    left: 0;
     -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
  
}

.evento .paciente_nome {
    display:block;
     -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
  
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size:10px;
    color:black;
    width:70%;
}
.evento .horario {
    display:block;
    position: absolute;
  top:0;
  right:0;
  padding:2px;
  background-color:white;
  border-radius:2px;
  
    font-size:8px;
    color:black;
    
}

.evento .description {
    display:hidden;

}
.linha {
    border-top: 1px solid blue;
    width: 100%;
}

.horarios_row {
    height: 26px;
    margin-top: -13px;
    border: 1px solid blue;
    background-color: #fff;
    border-radius: 13px;
    -moz-border-radius: 13px;
    -webkit-border-radius: 13px;
}

.evento .tool-container {
    position: relative;
    height: 100%;
    transition-duration: 4s;
}

.evento .tool-container .tools {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 0;
    overflow: hidden;
    transition-duration: 4s;
}

.evento .tool-container:hover .tools {
    height: auto;
}

.btn-rounded {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #fff;
}
</style>
