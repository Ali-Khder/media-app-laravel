<?php

namespace App\Http\Traits;

trait ResponseTrait
{
    public function myresponse($status, $msg, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $msg,
            'data' => $data,
        ];
        return response($response);
    }
}
