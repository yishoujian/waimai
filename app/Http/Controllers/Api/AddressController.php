<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends BaseController
{
    /**
     * 添加收货地址
     */
    public function add(Request $request)
    {

        //得到所有数据
        $data=$request->post();
//
        $is_default=0;
    $data['is_default']=$is_default;
//        dd($data);
        //判断字段是否合法
       $validator= Validator::make($data,[
           'name'=>'required',
            'provence'=>'required',
          'city'=>'required',
          'area'=>'required',
          'detail_address'=>'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
            ],
        ]);
        if ($validator->fails()){
            //错误
            return[
              'status'=>'false',
              'message'=>$validator->errors()->first(),
            ];
        }
        //入库
        Address::create($data);
        return[
          'status'=>'true',
          'message'=>'添加地址成功'
        ];

    }

    /**
     * @param Request $request
     * @return mixed
     * 收货地址列表
     */

    public function list(Request $request)
    {
        //通过ID找到用户
      $id=$request->user_id;
      //得到地址
       return Address::where('user_id',$id)->get();
       dd( Address::where('user_id',$id)->get());

    }

    /**
     * //修改回显收货地址
     */
    public function edit(Request $request)
    {
        //通过ID得到对应的地址
       return $data=Address::findOrFail($request->id);
//        dd($data);
    }

    /**
     * 修改收货地址
     */
    public function update(Request $request)
    {
        $data=Address::findOrFail($request->id);
        $data1=$request->input();
        //判断字段是否合法
        $validator= Validator::make($data1,[
            'name'=>'required',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
            ],
        ]);
        //错误
        if ($validator->fails()){
            return [
                'status'=>'false',
                'message'=>$validator->errors()->frist(),
            ];
        };
        //入库
       $data->update($data1);
        return [
            'status'=>'true',
            'message'=>'修改地址成功',
        ];


    }




}
