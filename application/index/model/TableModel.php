<?php

/**
 * Created by Qiang.
 * User: Fuqiang Wang
 * Date: 2018/10/4
 * Time: 10:50
 */
namespace app\index\model;

class TableModel extends Base
{
    //获得数据库里面所有的表
    public static function getTableAll()
    {
        $table=self::query("SELECT TABLE_NAME,table_comment FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA ='".config('dataname')."'");
        return $table;
    }

    public static function getTableField($tableName)
    {
        return self::query('select COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT from information_schema.COLUMNS where table_name = "'.$tableName.'"');
    }

}