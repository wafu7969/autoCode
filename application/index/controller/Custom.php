<?php
/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/4
 * Time: 10:16
 * 自定义生成
 */

namespace app\index\controller;
use app\index\event\CreateApi;
use app\index\event\CreateEvent;
use app\index\event\CreateModel;
use app\index\model\TableModel;

class Custom extends Base
{

    //自定义生成首页
    public function index()
    {

        //读取数据库所有的表
        $table=TableModel::getTableAll();
        $this->assign('table',$table);
        //读取分组
        $group=config('group');
        foreach($group as $key=>$value)
        {
             $groupItem[]=$key;
        }
        $this->assign('groupItem',$groupItem);
        return $this->fetch();
    }


    //格式化首页数据
    public function format()
    {
        $data=input('param.');
        if(!empty($data))
        {
            $getArray=explode('$$$$',$data['data']);
            foreach($getArray as $key=>$value)
            {

                $jsonArray[] = json_decode($value, true);

            }
            return $this->returnJson($jsonArray);
        }
    }

    //添加模型的方法页
    public function addMethod()
    {
        $data=input('param.');
        //获取某张表的所有字段
        $field=TableModel::getTableField($data['tableName']);
        $this->assign('tableName',$data['tableName']);
        $this->assign('field',$field);
        return $this->fetch();
    }

    //生成对应的文件
    public function make()
    {
        $data=input('param.');

        if(empty($data['tableName']))
        {
            return $this->returnJson('','没有选择数据表！',0);
        }

        if(empty($data['group']))
        {
            return $this->returnJson('','没有选择生成的分组！',0);
        }

        $error="";
        //获得生成的文件名称
        $tableName=$data['tableName'];
        $fileName=str_replace(config('prefix'),'',$tableName);

        //生成api-----------------------------------------------------------
        if(isset($data['api']) && !empty($data['api']))
        {

            $apiMethod="";
            foreach($data['api'] as $key=>$value)
            {
                $apiMethod.="\n".$value;
            }
            $group=config('group');
            $api_path=$group[$data['group']]['api'];
            $api_path.="\\".ucfirst($fileName).".php";

            //读取模板文件
            $temp=config('temp');
            $tempPath=$temp[$data['group']];
            $temp = file_get_contents($tempPath.'\api.php');
            //替换模板里面的标签
            $temp=$this->replaceNotes($temp);
            $temp=str_replace('{$api_name$}',ucfirst($fileName),$temp);
            $temp=str_replace('{$method$}',$apiMethod,$temp);

            if(!file_exists($api_path))
            {

                //写入文件
                $myfile = fopen($api_path, "w") or die("Unable to open file!");

                fwrite($myfile, $temp);
                fclose($myfile);
            }
            else
            {
                //追加写入
                //$handle=fopen($api_path,"w");
                //fwrite($handle,$temp);
                $error.="api已经存在，建议手动添加！";
            }

        }



        //生成event-------------------------------------------------------
        if(isset($data['event']) && !empty($data['event']))
        {
            $eventMethod="";
            foreach($data['event'] as $key=>$value)
            {
                $eventMethod.="\n".$value;
            }

            $group=config('group');
            $event_path=$group[$data['group']]['event'];
            $event_path.="\\".ucfirst($fileName)."Event.php";

            //读取模板文件
            $temp=config('temp');
            $tempPath=$temp[$data['group']];
            $temp = file_get_contents($tempPath.'\event.php');
            //替换模板里面的标签
            $temp=$this->replaceNotes($temp);
            $temp=str_replace('{$api_name$}',ucfirst($fileName),$temp);
            $temp=str_replace('{$method$}',$eventMethod,$temp);

            if(!file_exists($event_path))
            {
                //写入文件
                $myfile = fopen($event_path, "w") or die("Unable to open file!");
                fwrite($myfile, $temp);
                fclose($myfile);

            }
            else
            {
                //追加写入
                //$handle=fopen($event_path,"w");
                //fwrite($handle,$temp);
                $error.="event已经存在，建议手动添加！";
            }

        }



        //生成model------------------------------------------------------------------
        if(isset($data['model']) && !empty($data['model']))
        {
            $modelMethod="";
            foreach($data['model'] as $key=>$value)
            {
                $modelMethod.="\n".$value;
            }

            $group=config('group');
            $model_path=$group[$data['group']]['model'];
            $model_path.="\\".ucfirst($fileName)."Model.php";

            //读取模板文件
            $temp=config('temp');
            $tempPath=$temp[$data['group']];
            $temp = file_get_contents($tempPath.'\model.php');
            //替换模板里面的标签
            $temp=$this->replaceNotes($temp);
            $temp=str_replace('{$api_name$}',ucfirst($fileName),$temp);
            $temp=str_replace('{$tableName$}',$fileName,$temp);
            if(isset($data['is_autoWriteTimestamp']) && $data['is_autoWriteTimestamp']==1)
            {
                $temp=str_replace('{$autoWriteTimestamp$}','protected $autoWriteTimestamp=true;',$temp);
            }
            else
            {
                $temp=str_replace('{$autoWriteTimestamp$}','',$temp);
            }

            $temp=str_replace('{$method$}',$modelMethod,$temp);

            if(!file_exists($model_path))
            {

                //写入文件
                $myfile = fopen($model_path, "w") or die("Unable to open file!");

                fwrite($myfile, $temp);
                fclose($myfile);
            }
            else
            {
                //追加写入
                //$handle=fopen($model_path,"w");
                //fwrite($handle,$temp);
                $error.="model已经存在，建议手动添加！";
            }

        }

        return $this->returnJson('','生成成功！'.$error);
    }

    public function replaceNotes($temp)
    {
        $temp=str_replace('{$copyright$}',config('copyright'),$temp);
        $temp=str_replace('{$user_name$}',config('user_name'),$temp);
        $temp=str_replace('{$create_date$}',date('Y-m-d'),$temp);
        $temp=str_replace('{$create_time$}',date('H:i:s'),$temp);

        return $temp;
    }



    //预览页
    public function preview()
    {
        $data=input('param.');
        $api=$event='';
        //获得model层
        $createModel=new CreateModel();
        $model=$createModel->create($data);
        $this->assign('model',$model);


        //获得event层
        if(isset($data['is_event']) && $data['is_event']==1)
        {
            $createEvent = new CreateEvent();
            $event = $createEvent->create($data);
        }

        if(isset($data['is_api_event']) && $data['is_api_event']==1)
        {
            //获得api层
            $createApi=new CreateApi();
            $api=$createApi->create($data);

            $createEvent = new CreateEvent();
            $event = $createEvent->create($data);
        }

        $this->assign('event',$event);
        $this->assign('api',$api);
        return $this->fetch();
    }


    //提交
    public function postMethod()
    {
        $data=input('param.');
        //获得model层
        $createModel=new CreateModel();
        $model=$createModel->create($data);
        //获得event层
        $createEvent=new CreateEvent();
        $event=$createEvent->create($data);
        //获得api层
        $createApi=new CreateApi();
        $api=$createApi->create($data);

        $data=['model'=>$model,'event'=>$event,'api'=>$api];
        return $this->returnJson($data);
    }


    //返回所有表名
    //返回json格式
    public function getTableAll()
    {
        //读取数据库所有的表
        $table=TableModel::getTableAll();
        return $this->returnJson($table);
    }


    //获得某张表的所有字段 包含字段名、类型、注释
    //返回json格式
    public function getTableField()
    {
        $data=input('param.');
        $field=TableModel::getTableField($data['tableName']);
        return $this->returnJson($field);
    }

}