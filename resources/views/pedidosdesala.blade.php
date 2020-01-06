@extends('layouts.app')


@include('Assets/require_admin')
@include('Assets/require_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Pedidos de Sala') }}</h1></div>
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
                                @foreach(DB::table('cadeira_eventos')
                                    ->select('id','nome','cadeira_id','descricao','data_inicio','data_fim')
                                    ->where([
                                        'aceite' => '0'
                                    ])->get() as $evento)
                                        <tr>
                                            <td>{{$evento->nome}}</td>
                                            <td>{{DB::table('cadeira')->select('nome')->where(['id' => $evento->cadeira_id])->first()->nome}}</td>
                                            <td>{{$evento->descricao}}</td>
                                            <td>{{$evento->data_inicio}}</td>
                                            <td>{{$evento->data_fim}}</td>
                                            <td>
                                                <form METHOD="post" action="{{route('api_aceitar_rejeitar_sala')}}">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$evento->id}}">
                                                    <input type="submit" name="submit" value="Aceitar">
                                                    <input type="submit" name="submit" value="Eliminar">
                                                    <p></p>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                        @else
                            Sem pedidos para aceitar
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
