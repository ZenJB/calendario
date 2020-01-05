@extends('layouts.app')


@include('Assets/require_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Cadeiras disponiveis na universidade') }}</h1></div>

                </div>
                <p></p>
                @if(isset($cadeiras))
                    @foreach($cadeiras as $cadeira)
                        <div class="card">
                            <div class="card-header">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>
                                            <form method="POST" action="{{ _('api_alterar_cadeira') }}">
                                                <select id="curso" onchange="this.form.submit()">
                                                    @if(isset($cursos))
                                                        @foreach($cursos as $curso)
                                                            <option value="volvo">{{_($curso->curso)}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </form>
                                        </th>
                                        <th>{{ _($cadeira->nome) }}</th>
                                        <th>
                                            <form  method="POST" action="{{ route('api_remove_cadeira') }}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{_($cadeira->id)}}">
                                                <input type="submit" name="submit" value="Remover a Cadeira">
                                            </form>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                </div>
                        </div>
                        <p></p>
                    @endforeach
                @endif


                <div class="card">
                    <div class="card-header">{{ __('Adicionar Cadeira') }}</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Curso</th>
                                <th>Acao</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <form id="criar_cadeira" method="POST" action="{{ route('api_add_cadeira') }}">
                                        {{csrf_field()}}
                                        <input type="text" name="name" value="">
                                    </form>
                                </td>
                                <td>
                                    <select form="criar_cadeira" name="curso">
                                        @if(isset($cursos))
                                            @foreach($cursos as $curso)
                                                <option value="{{_($curso->id)}}">{{_($curso->curso)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input form="criar_cadeira" type="submit" name="submit" value="Criar Cadeira">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
