<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use Response;

class API extends Controller
{
    //
    function getFromUMa($id){
        $id_uma = DB::table('utilizadores')
            ->select('identificacao_uma')
            ->where('id', $id)
            ->get()
            ->first()
            ->identificacao_uma;

        $eventos = DB::table('cadeira_eventos')
            ->join('aluno_has_cadeira', 'cadeira_eventos.cadeira_id', '=', 'aluno_has_cadeira.cadeira_id')
            ->where('aluno_id', $id)
            ->get(array(
                'id',
                'nome',
                'descricao',
                'data_inicio',
                'data_fim',
                'tipo_de_evento'
            ));

        $calendario = file_get_contents('http://calendar.uma.pt/'.$id_uma);
        //Split calendar in 2 (remove bottom)
        $calendario_inicio = explode('END:VCALENDAR',$calendario)[0];
        foreach ($eventos as $evento){
            $novo_evento = "BEGIN:VEVENT"."\r\n";
            $data_inicio = str_replace("-","",str_replace(" 00:00:00","",$evento->data_inicio));
            $data_fim = str_replace("-","",str_replace(" 00:00:00","",$evento->data_fim));
            $novo_evento .= "UID:UMa".$id_uma."_".$data_inicio."_0000_".$evento->id."\r\n";
            $novo_evento .= "DTSTART:".$data_inicio."T080000Z"."\r\n";
            $novo_evento .= "DTEND:".$data_fim."T080000Z"."\r\n";
            $novo_evento .= "SUMMARY:".$evento->nome."\r\n";
            $novo_evento .= "LOCATION:".$evento->descricao."\r\n";
            $novo_evento .= "DESCRIPTION:".$evento->descricao."\r\n";
            $novo_evento .= "END:VEVENT\r\n";
            $calendario_inicio .= $novo_evento;
        }
        $calendario_final = $calendario_inicio."END:VCALENDAR\r\n";

        $headers = [
            'Content-type' => 'text/iCal',
            'Content-Length' => strlen($calendario_final)
        ];
        return Response::make($calendario_final, 200, $headers);
    }
}
