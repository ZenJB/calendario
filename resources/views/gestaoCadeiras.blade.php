@extends('layouts.app')


@include('Assets/require_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Cadeiras disponiveis na universidade') }}</h1></div>
                    @if(isset($cadeiras))
                        <table>
                            <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Cadeira</th>
                                <th>Responsavel</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cadeiras as $cadeira)
                                <tr>
                                    <td>
                                        <form method="POST" id="form_alterar_cadeira_{{ _($cadeira->id) }}" action="{{ route('api_alterar_cadeira') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="cadeira" value="{{ _($cadeira->id) }}">
                                            <select id="curso" name="curso" onchange="this.form.submit()">
                                                @if(isset($cursos))
                                                    @foreach($cursos as $curso)
                                                        @if(DB::table('cadeira_curso')->select('cadeira_id','curso_id')->where(['cadeira_id' => $cadeira->id,'curso_id' => $curso->id])->count() > 0)
                                                            <option value="{{_($curso->id)}}" selected>{{_($curso->curso)}}</option>
                                                        @else
                                                            <option value="{{_($curso->id)}}">{{_($curso->curso)}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ _($cadeira->nome) }}</td>
                                    <td>
                                        <select form="form_alterar_cadeira_{{ _($cadeira->id) }}" name="docente">
                                            @if(isset($docentes))
                                                @foreach($docentes as $docente)
                                                    @if(DB::table('cadeira_docente')->select('cadeira_id','docente_id')->where(['cadeira_id' => $cadeira->id, 'docente_id' => $docente->id])->count() > 0)
                                                        <option value="{{_($docente->id)}}" selected>{{DB::table('utilizadores')->select('name')->where(['id' => $docente->id])->first()->name}}</option>
                                                    @else
                                                        <option value="{{_($docente->id)}}">{{DB::table('utilizadores')->select('name')->where(['id' => $docente->id])->first()->name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input form="form_alterar_cadeira_{{ _($cadeira->id) }}" type="submit" name="submit" value="Alterar">
                                        <form  method="POST" action="{{ route('api_remove_cadeira') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{_($cadeira->id)}}">
                                            <input type="submit" name="submit" value="Remover">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <p></p>

                <div class="card-small">
                    <div class="card-header">{{ __('Adicionar Cadeira') }}</div>
                    <table>
                        <thead>
                        <tr>
                            <th>Cadeira</th>
                            <th>Curso</th>
                            <th>Responsavel</th>
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
                                <select form="criar_cadeira" name="docente">
                                @if(isset($docentes))
                                    @foreach($docentes as $docente)
                                            <option value="{{_($docente->id)}}">{{DB::table('utilizadores')->select('name')->where(['id' => $docente->id])->first()->name}}</option>
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
