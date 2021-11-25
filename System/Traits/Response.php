<?php

namespace Master\Traits;

trait Response 
{

    public function JWT(array $jwt)
    {

        // Key

        $key = $jwt["key"];


        // Header

        $header = [
            "typ" => $jwt["typ"],
            "alg" => $jwt["alg"]
        ];

        // Payload

        $payload = $jwt["data"];

        // JSON

        $header = json_encode($header);
        $payload = json_encode($payload);

        // Base 64

        $header = base64_encode($header);
        $payload = base64_encode($payload);


        // Sign

        $sign = hash_hmac($jwt["cript"],$header . '.' . $payload, $key, True); 

        $sign = base64_encode($sign);

        // Token

        $token = $header . '.' . $payload . '.' . $sign;

        // return

        return $token;
    }


    public function response ($response,$code=null)
    {
        header("Content-Type: application/json");

        if (is_null($code))
        {
            $code = 200;
        }

        http_response_code($code);

        echo json_encode(array(
            "code" => $code,
            "data" => $response
        ));
        
    }


    public function responseNotFound($response)
    {

        return $this->response($response,400);

    }


    public function serverError($response)
    {

        return $this->response($response,500);

    }
}