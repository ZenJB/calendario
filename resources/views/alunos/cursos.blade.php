@extends('layouts.app')


@include('Assets/require_login')
@include('Assets/require_aluno')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Cursos Inscritos') }}</div>


                        @if(count($cursos) == 0)
                            <p>Nao esta inscrito em nenhum curso</p>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Acao</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cursos as $curso)
                                <tr>
                                    <td>
                                        {{ _(DB::Table('curso')->find($curso->curso_id)->curso) }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('api_delete_curso') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="aluno" value="{{ _( Auth::user()->id ) }}">
                                            <input type="hidden" name="curso" value="{{ _($curso->curso_id) }}">
                                            <input type="submit" value="Sair do Curso">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
                <p></p>

                @if(count($cursos) != count($lista_cursos))
                    <div class="card">
                        <div class="card-header">{{ __('Efetuar inscricao num curso') }}</div>
                            <form method="POST" action="{{ route('api_add_curso') }}">
                                {{csrf_field()}}
                                <input type="hidden" name="aluno" value="{{ _( Auth::user()->id ) }}">
                                <select name="curso">
                                    @foreach($lista_cursos as $curso)
                                        @if(count($cursos) == 0)
                                            <option value="{{ _($curso->id) }}">{{ _($curso->curso) }}</option>
                                        @else
                                            @foreach($cursos as $curso_inscrito)
                                                @if($curso_inscrito->curso_id != $curso->id)
                                                    <option value="{{ _($curso->id) }}">{{ _($curso->curso) }}</option>
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
