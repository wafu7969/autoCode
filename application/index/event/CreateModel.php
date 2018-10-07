<?php

/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/4
 * Time: 20:33
 * 生成模型文件
 */

namespace app\index\event;
use app\index\controller\Base;

class CreateModel extends Base
{
    public function create($data)
    {
        //查询
        switch($data['method'])
        {
            //查询
            case 'select':
                return $this->select($data,'select');
                break;
            //查询
            case 'find':
                return $this->select($data,'find');
                break;
            // 保存
            case 'save':
                return $this->select($data,'save');
                break;
            //更新
            case 'update':
                return $this->select($data,'update');
                break;
            //统计
            case 'count':
                return $this->select($data,'count');
                break;
            //求和
            case 'sum':
                return $this->select($data,'sum');
                break;
        }
    }


    //生成model层的方法
    public function select($data,$method)
    {
        if(empty($data['method_name']))
        {
            return $this->returnJson('方法名不能为空！','error',0);
        }

        //形成查询返回的字段、join的表、where条件
        $filedJoinWhere=$this->groupFiledJoinWhere($data);

        $join='';
        //联合查询组合条件
        if(!empty($filedJoinWhere['join']))
        {
            $join=$filedJoinWhere['join'];
        }

        //组合成$where及生成$where的代码
        $methodStr='';
        $where='';
        if(!empty($filedJoinWhere['where']))
        {
            $where='where($where)->';
            foreach($filedJoinWhere['where'] as $key=>$value)
            {
                if($value['condition']!='between')
                {
                    if(isset($value['is']) && $value['is']==1)
                    {
                        if($value['value']=='')
                        {
                            $methodStr.='$where[\''.$key.'\']=[\''.$value['condition'].'\',$data[\''.$value['field'].'\']];';
                            $methodStr.="\n\t";
                        }
                        else
                        {
                            $methodStr=$methodStr.'$where[\''.$key.'\']=[\''.$value['condition'].'\','.$value['value'].'];';
                            $methodStr.="\n\t";
                        }
                    }
                    else
                    {
                        $methodStr.='if(isset($data[\''.$value['field'].'\']) && !empty($data[\''.$value['field'].'\']))';
                        $methodStr.="\n\t";
                        $methodStr.='{';
                        $methodStr.="\n\t\t";
                        $methodStr.= '$where[\''.$key.'\']=[\''.$value['condition'].'\',$data[\''.$value['field'].'\']];';
                        $methodStr.="\n\t";
                        $methodStr.='}';
                        $methodStr.="\n\t";
                    }
                }
                else
                {

                }

            }
        }

        $sql='';
        if(!empty($join))
        {
            $sql.=$join;
        }

        if(!empty($where))
        {
            $sql.=$where;
        }

        //组装
        switch($method)
        {
            //select查询
            case 'select':

                if(!empty($filedJoinWhere['field']))
                {
                    $sql.="field('".$filedJoinWhere['field']."')->";
                }

                $sql=$sql.$filedJoinWhere['order'];
                //是否分页
                if(isset($data['is_page']) && $data['is_page']==1)
                {
                    $sql.='paginate('.$data['page_size'].');';
                }
                else
                {
                    $sql.='select();';
                }
                break;
            //find查询
            case 'find':

                if(!empty($filedJoinWhere['field']))
                {
                    $sql.="field('".$filedJoinWhere['field']."')->";
                }

                $sql.='find();';
                break;
            //保存
            case 'save':
                $sql.='allowField(true)->';
                $sql.='save($data);';
                break;
            //更新
            case 'update':
                $sql.='allowField(true)->';
                $sql.='update($data);';
                break;
            //统计
            case 'count':
                $sql.='count();';
                break;
            //求和
            case 'sum':
                $sql.='sum();';
                break;
        }

        $sql='return self::'.$sql;

        $method_note=isset($data['method_note'])?$data['method_note']:"";
        $returnMethod="//".$method_note;
        $returnMethod.="\n";
        $returnMethod.='public static function '.$data['method_name'].'($data)';
        $returnMethod.="\n";
        $returnMethod.="{";
        $returnMethod.="\n\t";
        $returnMethod.=$methodStr;
        $returnMethod.="\n\t";
        $returnMethod.=$sql;
        $returnMethod.="\n";
        $returnMethod.="}";

        return $returnMethod;

    }


    //返回的查询字段、关联的表、查询的条件
    public function groupFiledJoinWhere($data)
    {
        $join_table_name=$data['join_table_name'];
        $join_table_alias=$data['join_table_alias'];
        $join_table_condition=$data['join_table_condition'];

        $returnField=[];
        $returnWhere=[];
        $joinStr='';
        //判断是否需要关联表查询
        //有
        if(isset($data['is_join']) && $data['is_join']==1)
        {
            if(count($data['join_table_name'])>1)
            {
                foreach($data['join_table_alias'] as $key=>$value)
                {
                    if(empty($value))
                    {
                        return $this->returnJson('关联查询表的别名不能为空！','error',0);
                    }
                }
            }

            foreach($join_table_name as $key=>$value)
            {
                //获取主表的别名和join方式
                if($key==0)
                {
                    $joinStr="alias('".$join_table_alias[$key]."')->";
                    $joinType=$join_table_condition[$key];
                    $order="order('".$join_table_alias[$key].".id desc')->";
                }
                //获得附表的join条件
                else
                {
                    $joinStr=$joinStr."join('".$value." ".$join_table_alias[$key]."','".$join_table_condition[$key]."','".$joinType."')->";
                }

                //获得所有返回的字段和查询条件
                $fields=$data[$value];
                foreach($fields as $kkey=>$vvalue)
                {
                    if(isset($vvalue['is_back']))
                    {
                        if(!empty($vvalue['alias']))
                        {
                            $returnField[]=$data['join_table_alias'][$key].'.'.$kkey.' AS '.$vvalue['alias']; //有别名
                        }
                        else
                        {
                            $returnField[]=$data['join_table_alias'][$key].'.'.$kkey;
                        }
                    }

                    //查询条件
                    if(!empty($vvalue['where']['condition']))
                    {
                        $vvalue['where']['field']=$kkey; //记录没有前缀的表字段
                        $returnWhere[$join_table_alias[0].'.'.$kkey]=$vvalue['where'];
                    }
                }
            }

        }
        //没有
        else
        {

            foreach($join_table_name as $key=>$value)
            {
                $fields=$data[$value];

                foreach($fields as $kkey=>$vvalue)
                {
                    if(isset($vvalue['is_back']))
                    {
                        if(!empty($vvalue['alias']))
                        {
                            $returnField[]=$kkey.' AS '.$vvalue['alias']; //有别名
                        }
                        else
                        {
                            $returnField[]=$kkey;
                        }
                    }

                    if(!empty($vvalue['where']['condition']))
                    {
                        $vvalue['where']['field']=$kkey; //记录表字段
                        $returnWhere[$kkey]=$vvalue['where'];
                    }
                }
            }

            $order="order('id desc')->";
        }

        return array('join'=>$joinStr,'field'=>implode(',',$returnField),'where'=>$returnWhere,'order'=>$order);
    }



}