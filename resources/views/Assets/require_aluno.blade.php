@if (DB::Table('alunos')->find(Auth::user()->id) == null)
    <script>window.location = "/";</script>
@endif
