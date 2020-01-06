@extends('layouts.app')


@include('Assets/require_login')

@section('content')

        <p>Link do seu calendário: <a href="http://ivanteixeira.tk/api/calendar/{{_(Auth::user()->id)}}">http://ivanteixeira.tk/api/calendar/{{_(Auth::user()->id)}}</a> </p>
        <iframe id="open-web-calendar"
                src="https://openwebcalendar.herokuapp.com/calendar.html?url=http://83.223.180.99/api/calendar/{{_(Auth::user()->id)}}&amp;language=pt"
                sandbox="allow-scripts allow-same-origin allow-top-navigation"
                allowTransparency="true" scrolling="no"
                frameborder="0" height="600px" width="100%">
        </iframe>
@endsection
