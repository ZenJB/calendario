@if (DB::Table('administradores')->find(Auth::user()->id) == null)
    <script>window.location = "/";</script>
@endif
