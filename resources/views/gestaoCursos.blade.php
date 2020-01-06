@extends('layouts.app')


@include('Assets/require_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Cursos disponiveis na universidade') }}</h1></div>
                    @if(isset($cursos))
                        @foreach($cursos as $curso)
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        <form id="form_alterar_curso_{{ _($curso->id) }}" method="POST" action="{{ route('api_alterar_curso_db') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="curso" value="{{ _($curso->id) }}">
                                        </form>
                                    </th>
                                    <th><input form="form_alterar_curso_{{ _($curso->id) }}" name="name" value="{{ _($curso->curso) }}"> </th>
                                    <th>
                                        <input form="form_alterar_curso_{{ _($curso->id) }}" type="submit" value="Alterar nome do curso">
                                    </th>
                                    <th>
                                        <form  method="POST" action="{{ route('api_remove_curso_db') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{_($curso->id)}}">
                                            <input type="submit" name="submit" value="Remover o Curso">
                                        </form>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        @endforeach
                    @endif
                </div>
                <p></p>

                <div class="card-small">
                    <div class="card-header">{{ __('Adicionar Curso') }}</div>
                    <table>
                        <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Acao</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <form id="criar_curso" method="POST" action="{{ route('api_add_curso_db') }}">
                                    {{csrf_field()}}
                                    <input type="text" name="name" value="">
                                </form>
                            </td>
                            <td>
                                <input form="criar_curso" type="submit" name="submit" value="Criar Cadeira">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
