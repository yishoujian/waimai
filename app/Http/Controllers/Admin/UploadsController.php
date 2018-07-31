<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
    /**
     *文件上传处理
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {


        //接收input中的name的值是file
        $file=$request->file("file");
        if ($file!==null){
            $fileName = $request->file('file')->store("shop", "oss");
            $data = [
                'status' => 1,
                'url' => env("ALIYUN_OSS_URL").$fileName
            ];


        }else{
            $data = [
                'status' => 0,
                'url' => ""
            ];
        }


        return $data;
    }
}
