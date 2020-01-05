@extends('layouts.app')


@include('Assets/require_login')
@include('Assets/require_aluno')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Cadeiras Inscritas') }}</div>


                    @if(count($cadeiras) == 0)
                        <p>Nao esta inscrito em nenhuma cadeira</p>
                    @else
                        <table>
                            <thead>
                            <tr>
                                <th>Cadeira</th>
                                <th>Acao</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cadeiras as $cadeira)
                                <tr>
                                    <td>
                                        {{ _(DB::Table('cadeira')->find($cadeira->cadeira_id)->nome) }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('api_delete_cadeira') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="aluno" value="{{ _( Auth::user()->id ) }}">
                                            <input type="hidden" name="cadeira" value="{{ _($cadeira->cadeira_id) }}">
                                            <input type="submit" value="Sair da Cadeira">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
                <p></p>

                @if(count($cadeiras) != count($lista_cadeiras))
                    <div class="card">
                        <div class="card-header">{{ __('Efetuar inscricao numa cadeira') }}</div>
                        <form method="POST" action="{{ route('api_add_cadeira') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="aluno" value="{{ _( Auth::user()->id ) }}">
                            <select name="cadeira">
                                @foreach($lista_cadeiras as $cadeira)
                                    @if(count($cadeiras) == 0)
                                        <option value="{{ _($cadeira->id) }}">{{ _($cadeira->nome) }}</option>
                                    @else
                                        @foreach($cadeiras as $cadeira_inscrito)
                                            @if($cadeira_inscrito->cadeira_id != $cadeira->id)
                                                <option value="{{ _($cadeira->id) }}">{{ _($cadeira->nome) }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <input type="submit" value="Efetuar Inscricao">
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
