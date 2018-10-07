<?php
/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/4
 * Time: 10:24
 */

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public function returnJson($data,$msg='ok',$state=1)
    {
        $returnData['code']=$state;
        $returnData['msg']=$msg;
        $returnData['data']=$data;
        return json($returnData);
    }

}