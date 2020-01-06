@extends('layouts.app')


@include('Assets/require_login')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Proximos Eventos') }}</div>
        <table>
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Sala</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cadeiras as $cadeira)
                <tr>
                    <td>{{_($cadeira->nome)}}</td>
                    <td>{{_($cadeira->descricao)}}</td>
                    <td>{{str_replace(" 00:00:00","",_($cadeira->data_inicio))}}</td>
                    <td>{{str_replace(" 00:00:00","",_($cadeira->data_fim))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
