<?php

class trello_api{
    private $key;
    private $token;

    public function __construct($key, $token){
        $this->key = $key;
        $this->token = $token;
    }

    public function request($type, $request, $args = false){
        if (!$args) {
            $args = array();
        } elseif (!is_array($args)) {
            $args = array($args);
        }

        if (strstr($request, '?')) {
            $url = 'https://api.trello.com/1/' . $request . '&key=' . $this->key . '&token=' . $this->token;
        } else {
            $url = 'https://api.trello.com/1/' . $request . '?key=' . $this->key . '&token=' . $this->token;
        }
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_VERBOSE, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CAINFO, dirname(__FILE__) .  '/trello.com.crt');

        if (count($args)) curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($args));

        switch ($type) {
            case 'POST':
                curl_setopt($c, CURLOPT_POST, 1);
                break;
            case 'GET':
                curl_setopt($c, CURLOPT_HTTPGET, 1);
                break;
            default:
                curl_setopt($c, CURLOPT_CUSTOMREQUEST, $type);
        }

        # dont care about ssl
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($c);
        echo curl_error($c);
        curl_close($c);

        return json_decode($data);
    }
}


function board_request($trello,$data){

    $data = $trello->request('GET', ("member/me/boards"));
    var_dump($data);
    $array_nombres_tableros = array();
    $array_id_tableros = array();
    foreach ($data as $tablero) {
        array_push($array_nombres_tableros, $tablero->name);
        array_push($array_id_tableros, $tablero->id);
    }
    var_dump($array_nombres_tableros);
    var_dump($array_id_tableros);

    $arr_tableros = array_combine($array_nombres_tableros, $array_id_tableros);
    return $arr_tableros;
}




?>