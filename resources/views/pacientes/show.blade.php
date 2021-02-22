@extends('template')
@section('title', 'Paciente')

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">Dados Básicos</h4>
            <div>

            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="form-group col-2">
                            <label for="ficha">Ficha</label>
                            <span type="text" id="ficha" name="ficha" class="form-control" placeholder="000" value="">
                                {{ $paciente->ficha }}</span>
                        </div>
                        <div class="form-group col-10">
                            <label for="nome">Nome</label>
                            <span type="text" id="nome" name="nome" class="form-control"> {{ $paciente->nome }}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="data_nasc">Data de Nascimento</label>
                            <span type="date" id="data_nasc" name="data_nasc" class="form-control">
                                {{ $paciente->data_nasc ? $paciente->data_nasc->format('d/m/Y') : '' }}
                            </span>
                        </div>

                        <div class="form-group  col-6">
                            <label for="email">Email</label>
                            <span type="email" id="email" name="email" class="form-control"
                                placeholder="exemplo@gmail.com">{{ $paciente->email }}
                            </span>
                        </div>

                        <div class="form-group col-2">

                            <label for="email">Sexo</label>
                            <span type="radio" name="sexo" class="form-control" id="sexo1">
                                {{ $paciente->sexo }}
                            </span>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-4">
                            <label for="convenio">Convênio</label>
                            <span class="form-control">{{ $paciente->convenio_nome }}</span>
                        </div>

                        <div class="form-group  col-4">
                            <label for="codigoAssociado">N. Associado</label>
                            <span type="text" id="codigoAssociado" name="codigoAssociado" class="form-control">
                                {{ $paciente->CodigoAssociado }}
                            </span>
                        </div>
                        <div class="form-group col-4">
                            <label for="dentista">Dentista</label>
                            <span class="form-control">{{ $paciente->dentista_nome }}</span>
                        </div>


                    </div>
                </div>
                <div class="col-4">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <img id="img_preview" class="img-thumbnail img-fluid" src="{{ $paciente->imagem }}" />

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
                        <span type="text" id="cep" name="cep" class="form-control cep" placeholder="Cep">
                            {{ $paciente->cep }}
                        </span>
                    </div>

                    <div class="form-group col-4">
                        <label for="rua">Rua</label>
                        <span type="text" id="rua" name="logradouro" class="form-control" placeholder="Rua">
                            {{ $paciente->logradouro }}
                        </span>
                    </div>

                    <div class="form-group col-2">
                        <label for="numero">Número</label>
                        <span type="number" id="numero" name="numero" class="form-control" placeholder="Número">
                            {{ $paciente->numero }}
                        </span>
                    </div>

                    <div class="form-group col-2">
                        <label for="complemento">Complemento</label>
                        <span type="text" id="complemento" name="complemento" class="form-control"
                            placeholder="Complemento">
                            {{ $paciente->complemento }}
                        </span>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-4">
                        <label for="bairro">Bairro</label>
                        <span type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro">
                            {{ $paciente->bairro }}
                        </span>
                    </div>

                    <div class="form-group col-4">
                        <label for="cidade">Cidade</label>
                        <span type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                            {{ $paciente->cidade }}
                        </span>
                    </div>

                    <div class="form-group col-2">
                        <label for="uf">Estado</label>
                        <span class="uf form-control"> {{ $paciente->uf }}</span>

                    </div>

                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Telefones</h4>
            </div>
            <div class="panel-body tel_area">
                <table class="table table-borded table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Telefone</th>
                            <th>Tipo</th>
                            <th>Contato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($telefones as $telefone)
                            <tr>
                                <td>{{ $telefone->telefone }}</td>
                                <td>{{ $telefone->tipo }}</td>
                                <td>{{ $telefone->contato }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">Observação</h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="form-group col-12">
                        <pre rows="10" cols="40" class="form-control" name="obs" id="obs">{{ $paciente->obs }}</pre>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('pacientes.destroy', $paciente->id) }}">
            {{ method_field('delete') }}
            @csrf
            <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-default" type="button">Editar</a>
            <input type="submit" class="btn btn-danger" value="Remover" />
        </form>


    </div>

@endsection
