<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
* Write code on Method
*
* @return response()
*/

if (! function_exists('get_estados')) {

    function get_estados($sel='', $tipo=1){

        //echo $sel.'|';

        $opcoes  = '';
        $estados = array('AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO');

        if($tipo === 1){

            foreach ($estados as $uf){
                $check   = ($sel == $uf) ? ' selected="selected"' : '';
                $opcoes .= '<option value="'.$uf.'"'.$check.'>'.$uf.'</option>';
            }

            $lista = $opcoes;

        } else {

            $lista = $sel;

        }

        return $lista;

    }

}

if (! function_exists('get_cidades')) {

    function get_cidades($lista, $tipo=1){

        $opcoes  = '';
        $cidades = array();

        if(count($lista) > 0){

            foreach($lista as $value){

                $implode = array();

                if($tipo === 1){
                    $parts   = explode(' ', $value->location->cidade);
                } else if($tipo === 3){
                    $parts   = explode(' ', $value->contato->cidade);
                } else {
                    $parts   = explode(' ', $value->cidade);
                }

                var_dump($value);

                foreach($parts as $item){
                    $implode[] = ucfirst($item);
                }
                $nome = implode(' ', $implode);
                $cidades[$nome] = $nome;

            }

            ksort($cidades);

            foreach($cidades as $cidade){
                $opcoes .= '<option value="'.$cidade.'">'.$cidade.'</option>';
            }

        } else {

            $opcoes = '<option value="">Nenhuma cidade encontrada</option>';

        }

        return $opcoes;

    }

}

if (! function_exists('limite')) {

    function limite($texto, $limite, $tipo=''){

        if(strlen($texto) <= $limite){

            $res = $texto;

        } else {

            $novo = substr($texto, 0, $limite).'...';

            if($tipo){
                $res = '<'.$tipo.' title="'.$texto.'" class="texto-limitado">'.$novo.'</'.$tipo.'>';
            } else {
                $res = '<span title="'.$texto.'" class="texto-limitado">'.$novo.'</span>';
            }

        }

        return $res;

    }

}