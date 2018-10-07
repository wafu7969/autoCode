<?php
/**
 * Created by {$copyright$}.
 * User: {$user_name$}
 * Date: {$create_date$}
 * Time: {$create_time$}
 */

namespace app\admin\model;

class {$api_name$}Model extends BaseModel
{
    protected $name='{$tableName$}';
    protected $pk='id';
    {$autoWriteTimestamp$}

    {$method$}
}