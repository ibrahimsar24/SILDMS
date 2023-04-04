<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/5 0005
 * Time: 15:49
 */

namespace App\Http\Controllers\Api\Traits;


use App\User;
use App\Card;
use Illuminate\Translation\Translator;

trait ApiResponse
{
    /**
     * @param array $data 当成功时返回有效数据
     * @param null $message 返回消息
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(array $data = [], $message = null)
    {
        $response = [
            'code'    => 200,
            'status'  => 'success',
            'message' => $message,
            'data' => $data,
        ];
//        if (count($data)>0)
//        {
//            $response['data']=$data;
//        } else {
//            $response['data']=[];
//        }
        return response()->json($response,200);
    }

    /**
     * @param array $data
     * @param null $code
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail( $code = null, $message = null)
    {
        return response()->json([
            'code'    => $code ?? 400,
            'status'  => 'fail',
            'message' => $message
        ],$code ?? 400);
    }
}
