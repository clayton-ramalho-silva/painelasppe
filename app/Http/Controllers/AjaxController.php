<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function getCep(Request $request){

        $cep    = $request->input('cep');
        $cep    = str_replace('-', '', $cep);
        $cidade = $bairro = $uf = $rua = '';

        if(is_numeric($cep)){

            $get = file_get_contents("https://viacep.com.br/ws/".$cep."/json/");

            if($get){

                $json = json_decode($get);

                if(isset($json->erro)){

                    $msg = '3';

                } else {

                    $msg    = '1';
                    $rua    = $json->logradouro;
                    $cidade = $json->localidade;
                    $bairro = $json->bairro;
                    $uf     = $json->uf;

                }

            } else {

                $msg = '3';

            }

        } else {

            $msg = '2';

        }

        $dados = array(
            'msg'    => $msg,
            'rua'    => $rua,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'uf'     => $uf,
        );

        echo json_encode($dados);

    }

}
