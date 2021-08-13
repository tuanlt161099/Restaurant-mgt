<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse; 

trait ApiTrait{
    /**
     * responseSuccess()
     *
     * @param string $message
     * @param mixed [$data = []]
     * @param int $statusCode
     *
     * Return JSON string to client when success
     */

    public function responseSuccess(string $message, $data = [], $statusCode = 200){
        $data = $this->convertIds2Text($data);
        $response = [
            "status" => "success",
            "message" => $message,
            "data" => $data
        ];
        return response()->json($response, $statusCode, ["Content-Type" =>"application/json;charset=UTF-8"]);
    }

     /**
     * responseError()
     *
     * @param string $message
     * @param mixed $errors
     * @param int $statusCode
     * Return JSON string to client when error
     */
    public function responseError(string $message, $errors = null, $statusCode = 400): JsonResponse
    {
        return response()->json(
            [
                'status' => 'error',
                'message' => $message,
                'errors' => $errors
            ],
            $statusCode,
            ['Content-Type' => 'application/json;charset=UTF-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

     /**
     * convertIds2Text()
     *
     * Convert all *id field to uuid string
     * @param mixed $data
     * @return mixed
     */

    public function convertIds2Text($data)
    {
        array_walk_recursive($data, function(&$item, $key){
            if(strpos($key, 'id') !== false && is_binary($item)) {
                $item = bin_to_uuid($item);
            }
        });

        return $data;
    }

    /**
     * convertIds2Bin()
     *
     * Convert all *id field to bin(16)
     * @param mixed $data
     * @return mixed
     */

    public function convertIds2Bin($data)
    {
        array_walk_recursive($data, function(&$item, $key){
            if(strpos($key, 'id') !== false) {
                $item = uuid_to_bin($item);
            }
        });

        return $data;
    }
}