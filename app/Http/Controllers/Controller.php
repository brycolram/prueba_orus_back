<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($data, $code = 200)
    {
        $response = [
            "success" => true,
            "message" => "",
            "data" => $data,
        ];
        return response($response, $code);
    }
}
