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
                            <th>Identificacao Academica</th>
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
                                        <input form="form_{{ _($user->id) }}" type="text" name="identificacao_uma" value="{{_($user->identificacao_uma)}}">
                                    </td>
                                    <td>
                                        <input form="form_{{ _($user->id) }}" type="submit" name="submit" value="Alterar">
                                        <input form="form_{{ _($user->id) }}" type="submit" name="submit" value="Remover">
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <p></p>
                <div class="card-small">
                    <div class="card-header">{{ __('Adicionar um novo utilizador') }}</div>
                    <table>
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Palavra Passe</th>
                            <th>Aluno</th>
                            <th>Docente</th>
                            <th>Administrador</th>
                            <th>Identificacao Academica</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <form id="insert_new_user_form" method="POST" action="{{ route('api_add_user') }}">
                                    {{csrf_field()}}
                                    <input type="text" name="name" placeholder="Nome">
                                </form>
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="email" name="email" placeholder="Email">
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="password" name="password" placeholder="password">
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="checkbox" name="permissions[]" value="aluno">
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="checkbox" name="permissions[]" value="docente">
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="checkbox" name="permissions[]" value="admin">
                            </td>
                            <td>
                                <input form="insert_new_user_form" type="text" name="identificacao_uma" value="" placeholder="xxxxxxx">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input form="insert_new_user_form" type="submit" value="Criar novo utilizador">
                </div>

            </div>
        </div>
    </div>
@endsection
