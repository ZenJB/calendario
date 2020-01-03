@extends('layouts.app')


@include('Assets/require_login')
@include('Assets/require_admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Gestao dos utilizadores') }}</div>
                    <table>
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Aluno</th>
                            <th>Docente</th>
                            <th>Administrador</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>


                                    <td>
                                        <form id="form_{{ _($user->id) }}" method="POST" action="{{ route('api_edit_user') }}">
                                            {{csrf_field()}}
                                            <input type="text" name="name" value="{{$user->name}}">
                                            <input type="hidden" name="id" value="{{ _($user->id) }}">
                                        </form>
                                    </td>
                                    <td>
                                        <input form="form_{{ _($user->id) }}"  type="text" name="email" value="{{$user->email}}">
                                    </td>
                                    <td>
                                        @if (DB::Table('alunos')->find($user->id) != null)
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="aluno" checked>
                                        @else
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="aluno">
                                        @endif
                                    </td>
                                    <td>
                                        @if (DB::Table('docentes')->find($user->id) != null)
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="docente" checked>
                                        @else
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="docente">
                                        @endif
                                    </td>
                                    <td>
                                        @if (DB::Table('administradores')->find($user->id) != null)
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="admin" checked>
                                        @else
                                            <input form="form_{{ _($user->id) }}" type="checkbox" name="permissions[]" value="admin">
                                        @endif
                                    </td>
                                    <td>
                                        <input form="form_{{ _($user->id) }}" type="submit" value="Alterar Permissoes">
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
