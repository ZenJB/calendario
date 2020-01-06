@if (DB::Table('docentes')->find(Auth::user()->id) == null)
    <script>window.location = "/";</script>
@endif
