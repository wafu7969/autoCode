<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:71:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\add.html";i:1538608883;s:72:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\edit.html";i:1538608883;s:71:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\del.html";i:1538608883;s:75:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\delList.html";i:1538608883;s:72:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\info.html";i:1538608883;s:73:"F:\5-myTool\CodeBuilder\public\tph2\codeRepository\amaze\Model\lists.html";i:1538608883;}*/ ?>
//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo getDbConfig('app_namespace'); ?>\<?php echo $moduleName; ?>\model;

use think\Model;

class <?php echo tableNameToModelName($tableName); ?> extends Model {
	<?php if($pk): ?>
	// 设置数据库主键字段
	protected $pk = '<?php echo $pk; ?>';
	<?php endif; if($trueTable): ?>
	// 设置当前模型对应的完整数据表名称
	protected $table = '<?php echo $trueTable; ?>';
	<?php endif; ?>
	    //新增
    public function add($request){
        $data = $request->param();
        foreach($data as $key=>$val){
            if(is_array($val)){    //处理checkbox情况
                $data[$key] = implode("#op#", $val);
            }
        }
        return $this->data($data)->allowField(true)->save();
    }
	    //修改
    public function edit($request){
        $data = $request->param();
        foreach($data as $key=>$val){
            if(is_array($val)){    //处理checkbox情况
                $data[$key] = implode("#op#", $val);
            }
        }
        return $this->allowField(true)->save($data, ['id' => $data['id']]);
    }
	    //删除
    public function del($request){
        $id = $request->param('id');
        return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>',  $id)->delete();
    }
	    //批量删除
    public function delList($request){
        $condition = $request->request('condition');
        return $this->destroy(json_decode($condition));
    }
	    //id单个查询
    public function info($request){
        $id = $request->param('id');		
        return $this->where('<?php echo (isset($pk) && ($pk !== '')?$pk:"id"); ?>', $id)->find();
    }
	    //列表
    public function lists($request, $itemNum = 12){	//每页显示12条数据
        $condition = $request->param('condition');
        return $this->where(json_decode($condition))->paginate($itemNum);
    }

}	