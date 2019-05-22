<?php

namespace App\Http;

use Laravel\Lumen\Http\ResponseFactory as Response;

class ResponseFactory extends Response{

    public function make($content = '', $status = 200, array $headers = []){
        $request = app('request');
        $acceptHeader = $request->header('accept');
        
        if(empty($acceptHeader)){
            return $this->json($content,$status,$headers);
        }
        
        $resultado = "";
        switch ($acceptHeader){
            case 'application/json':
                $resultado = $this->json($content,$status,$headers);
                break;
            case 'application/xml':
                $result = $this->getXML($content); // conteudo que quero serializar para xml
                break;
        }
        return $resultado;
    }

    protected function getXML($data){

        if($data instanceof Arrayable){
            $data = $data->toArray();
        }
        //zend
        $config = new Config(['result' => $data],true);
        $escritorXML = new Xml();

        return $escritorXML->toString($config);

    }
}