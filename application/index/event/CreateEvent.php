<?php
/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/5
 * Time: 18:01
 * 创建逻辑层代码
 */

namespace app\index\event;
use app\index\controller\Base;

class CreateEvent extends Base
{
    public function create($data)
    {
        $modelName=str_replace(config('prefix'),'',$data['join_table_name'][0].'Model');
        $method_name=$data['method_name'];

        $method_note=isset($data['method_note'])?$data['method_note']:"";
        $eventStr="//".$method_note;
        $eventStr.="\n";
        $eventStr.='public function '.$data['method_name'].'($data)';
        $eventStr.="\n";
        $eventStr.="{";
        $eventStr.="\n\t";
        $eventStr.='$'.$modelName.'=new '.ucfirst($modelName).'();';
        $eventStr.="\n\t";
        $eventStr.='return $'.$modelName.'->'.$method_name.'($data);';
        $eventStr.="\n";
        $eventStr.="}";

        return $eventStr;

    }

}