@extends('template')
@section('title', 'Novo Paciente')

@section('styles')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

    </style>

@endsection
@section('scripts')



    <script type="text/javascript">
        $(document).ready(function() {
            $("#cep").blur(function() {
                var cep = $(this).val();
                var validacep = /^[0-9]{5}-?[0-9]{3}$/;
                if (validacep.test(cep)) {
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");
                    $.getJSON("http://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                            $("#numero").focus();
                        } else {
                            //alert("CEP não encontrado.");
                            $("#modal1").modal();
                        }
                    });
                } else {
                    //alert("Formato de CEP inválido.");
                    $("#modal2").modal();
                }
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    $("#imagem").val(e.target.result);
                    $('.btn-file img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $("#imgInp").change(function() {
                readURL(this);
            });

            $(".btn-teladd").click(function() {
                var container = $(".tel_area");
                var tel = $(
                    '<tr>' +
                    '<td><input type="tel" id="tel"	name="tel[]" class="form-control telefone" placeholder="Telefone"></td>' +
                    '<td><select name="tipoTel[]"	class="form-control">' +
                    '	<option value="Celular">Celular</option>' +
                    '	<option value="Residencial">Residencial</option>' +
                    '	<option value="Comercial">Comercial</option>' +
                    '</select></td>' +
                    '<td><input type="text" id="contato"	name="contato[]" class="form-control" placeholder="Contato"></td>' +
                    '<td><button type="button" class="btn-remtel close" aria-label="Close">  <span aria-hidden="true">×</span></button></td>' +
                    '</tr>'
                );
                tel.find("input").val("");
                container.append(tel);
                $(".btn-remtel").click(function() {
                    $(this).parent().parent().remove();
                });
            });

        });

    </script>

@endsection

@section('content')

    <form role="form" action="{{ route('pacientes.store') }}" autocomplete="off" method="post"
        enctype='multipart/form-data'>
        @csrf
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Dados Básicos</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="ficha">Ficha</label>
                                <input type="text" value="{{ $next_ficha }}" id="ficha" name="ficha" class="form-control"
                                    placeholder="000" value="">
                            </div>
                            <div class="form-group col-10">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo"
                                    autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="data_nasc">Data de Nascimento</label>
                                <input type="date" id="data_nasc" name="data_nasc" class="form-control">
                            </div>

                            <div class="form-group  col-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="exemplo@gmail.com">
                            </div>

                            <div class="form-group col-2">
                                <label for="sexo">Sexo</label>
                                <select class="form-control" name="sexo" id="sexo">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-4">
                                <label for="convenio">Convênio</label>
                                <select name="convenio" class="form-control">
                                    @foreach ($convenios as $convenio)
                                        <option value="{{ $convenio->id }}">{{ $convenio->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group  col-4">
                                <label for="codigoAssociado">N. Associado</label>
                                <input type="text" id="codigoAssociado" name="codigoAssociado" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label for="dentista">Dentista</label>
                                <select name="dentista" class="form-control">

                                    @foreach ($dentistas as $dentista)
                                        <option value="{{ $dentista->id }}">{{ $dentista->nome }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </div>
                    <div class="col-4">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <img id="img_preview" class="img-thumbnail img-fluid" src="{{ asset('img/avatar.png') }}" />
                                <input type="file" id="imgInp" />
                                <input type="hidden" id="imagem" name="imagem" />
                            </span>
                        </span>
                    </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Endereço</h4>
                </div>
                <div class="panel-body">

                    <div class="row">

                        <div class="form-group col-2">
                            <label for="cep">Cep</label>
                            <input type="text" id="cep" name="cep" class="form-control cep" placeholder="Cep">
                        </div>

                        <div class="form-group col-4">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" name="logradouro" class="form-control" placeholder="Rua">
                        </div>

                        <div class="form-group col-2">
                            <label for="numero">Número</label>
                            <input type="number" id="numero" name="numero" class="form-control" placeholder="Número">
                        </div>

                        <div class="form-group col-2">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control"
                                placeholder="Complemento">
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-4">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
                        </div>

                        <div class="form-group col-4">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                        </div>

                        <div class="form-group col-2">
                            <label for="uf">Estado</label>
                            <select name="uf" class="uf form-control" id="uf">
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AM">AM</option>
                                <option value="AP">AP</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MG">MG</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="PR">PR</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="RS">RS</option>
                                <option value="SC">SC</option>
                                <option value="SE">SE</option>
                                <option value="SP">SP</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>

                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Telefones <span class="btn btn-primary btn-teladd">Adicionar</span></h4>
                </div>
                <div class="panel-body ">
                    <table class="table table-borded table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Telefone</th>
                                <th>Tipo</th>
                                <th>Contato</th>
                                <th>.</th>
                            </tr>
                        </thead>
                        <tbody class="tel_area">


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">Descrição</h4>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="form-group col-12">
                            <textarea rows="10" cols="40" class="form-control" name="obs" id="obs"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button type="reset" class="btn btn-default">Limpar</button>

    </form>

@endsection
