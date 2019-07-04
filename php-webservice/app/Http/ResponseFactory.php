<?php

namespace App\Http;

use Laravel\Lumen\Http\ResponseFactory as Response;
use Illuminate\Contracts\Support\Arrayable as Arrayable;
use Zend;

class ResponseFactory extends Response{

    public function make($content = '', $status = 200, array $headers = []){
        $request = app('request');
        $acceptHeader = $request->header('accept');
        
        if($acceptHeader == '*/*'){
            return $this->json($content,$status,$headers);
        }
        
        $resultado = "";
        switch ($acceptHeader){
            case 'application/json':
                $resultado = $this->json($content,$status,$headers);
                break;
            case 'application/xml':
                // echo 'die';die;
                $resultado = parent::make($this->getXML($content),$status,$headers); // conteudo que quero serializar para xml
                break;
        }
        return $resultado;
    }

    protected function getXML($data){

        if($data instanceof Arrayable){
        //     echo 'oi';die;
            $data = $data->toArray();
        }
        //zend
        $config = new \Zend\Config\Config(['result' => $data],true);
        $escritorXML = new \Zend\Config\Writer\Xml();

        return $escritorXML->toString($config);

    }
}