@extends('layouts.app')


@include('Assets/require_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('As suas aulas extra') }}</h1></div>
                    <table>
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Cadeira</th>
                            <th>Local</th>
                            <th>Data Inicio</th>
                            <th>Data Fim</th>
                            <th>Acao</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($cadeiras))
                            @foreach($cadeiras as $cadeira)
                                @if(DB::table('cadeira_docente')->select('cadeira_id', 'docente_id')->where(['cadeira_id' => $cadeira->id, 'docente_id' => Auth::id()])->count() > 0)
                                    @foreach(DB::table('cadeira_eventos')
                                    ->select('id','nome','cadeira_id','descricao','data_inicio','data_fim')
                                    ->where([
                                        'tipo_de_evento' => 'aula',
                                        'cadeira_id' => $cadeira->id,
                                        'aceite' => '1'
                                    ])->get() as $evento)
                                        <tr>
                                            <td>{{$evento->nome}}</td>
                                            <td>{{DB::table('cadeira')->select('nome')->where(['id' => $evento->cadeira_id])->first()->nome}}</td>
                                            <td>{{$evento->descricao}}</td>
                                            <td>{{$evento->data_inicio}}</td>
                                            <td>{{$evento->data_fim}}</td>
                                            <td>
                                                <form METHOD="post" action="{{route('api_delete_aula')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$evento->id}}">
                                                    <input type="submit" value="Eliminar">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            Não leciona nenhuma cadeira
                        @endif
                        </tbody>
                    </table>
                </div>
                <p></p>

                <div class="card-small">
                    <div class="card-header">{{ __('Adicionar Aula') }}</div>
                    <table>
                        <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Cadeira</th>
                            <th>Local</th>
                            <th>Data Inicio</th>
                            <th>Data Fim</th>
                            <th>Acao</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <form id="criar_aula" method="POST" action="{{ route('api_criar_aula') }}">
                                    {{csrf_field()}}
                                    <input type="text" name="titulo" value="">
                                </form>
                            </td>
                            <td>
                                @if(isset($cadeiras))
                                    <select form="criar_aula" name="cadeira">
                                        @foreach($cadeiras as $cadeira)
                                            @if(DB::table('cadeira_docente')->select('cadeira_id', 'docente_id')->where(['cadeira_id' => $cadeira->id, 'docente_id' => Auth::id()])->count() > 0)
                                                <option value="{{_($cadeira->id)}}">{{_($cadeira->nome)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    Não leciona nenhuma cadeira
                                @endif
                            </td>
                            <td>
                                <input form="criar_aula"  type="text" name="descricao" value="">
                            </td>
                            <td><input form="criar_aula"  type="date" name="data_inicio"></td>
                            <td><input form="criar_aula"  type="date" name="data_fim"></td>
                            <td>
                                <input form="criar_aula" type="submit" name="submit" value="Criar">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
