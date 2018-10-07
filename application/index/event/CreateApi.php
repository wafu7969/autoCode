<?php
/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/5
 * Time: 18:01
 * 创建api层代码
 */

namespace app\index\event;
use app\index\controller\Base;

class CreateApi extends Base
{
    public function create($data)
    {
        $eventName=str_replace(config('prefix'),'',$data['join_table_name'][0]);
        $method_name=$data['method_name'];
        $method_note=isset($data['method_note'])?$data['method_note']:"";
        $eventStr="//".$method_note;
        $eventStr.="\n";
        $eventStr.='public function '.$data['method_name'].'()';
        $eventStr.="\n";
        $eventStr.="{";
        $eventStr.="\n\t";
        $eventStr.='$data=input("param.");';
        $eventStr.="\n\t";


        $eventStr.='$result = $this->validate($data, \'Card.getCard\');';
        $eventStr.="\n\t";
        $eventStr.='if (true !== $result) {';
        $eventStr.="\n\t\t";
        $eventStr.='// 验证失败 输出错误信息';
        $eventStr.="\n\t\t";
        $eventStr.='$this->getError($result);';
        $eventStr.="\n\t";
        $eventStr.='}';
        $eventStr.="\n\t";


        $eventStr.='$'.$eventName.'=new '.ucfirst($eventName).'Event();';
        $eventStr.="\n\t";
        $eventStr.='$returnData=$'.$eventName.'->'.$method_name.'($data);';

        $eventStr.="\n\t";
        $eventStr.='$this->getSuccess($returnData);';

        $eventStr.="\n";
        $eventStr.="}";

        return $eventStr;

    }

}