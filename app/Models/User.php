<?php

namespace App\Models;

class User extends Data
{
    private ?string $token;
    private array $permissions;

//    public function __construct(?string $token, array $permissions)
//    {
//        $this->token = $token;
//        $this->permissions = $permissions;
//    }

    public function parse()
    {
        // TODO: Implement parse() method.

        $jsonData =   json_encode($this->data);

        var_dump($this->data);
        exit;

        $result['errCode'] = $jsonData["errCode"];
        $result['errMsg'] = $jsonData["errMsg"];
        $result['data'] = $jsonData["data"];


        var_dump($result);
        exit;
    }
}
