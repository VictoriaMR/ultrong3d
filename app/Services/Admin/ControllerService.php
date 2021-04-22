<?php 

namespace App\Services\Admin;

use App\Services\Base as BaseService;
use App\Models\Admin\Controller;

/**
 * 	admin 控制器类
 */
class ControllerService extends BaseService
{	
	protected static $constantMap = [
        'base' => Controller::class,
    ];

	public function __construct(Controller $model)
    {
        $this->baseModel =  $model;
    }

    public function getList() 
    {
    	return $this->baseModel->where(['status' => 1])->get();
    }

    public function getListFormat() 
    {
    	return $this->listFormat($this->getListCache());
    }

    protected function listFormat($list, $parentId = 0) 
    {
    	$returnData = [];
    	foreach ($list as $value) {
    		if ($value['parent_id'] == $parentId) {
    			$temp = $this->listFormat($list, $value['con_id']);
    			if (!empty($temp)) {
	    			$value['son'] = $temp;
    			}
	    		$returnData[] = $value;
    		}
    	}

    	return $returnData;
    }

    public function getListCache()
    {
        $cacheKey = 'ADMIN_CONTROLLER_LIST';
        $list = redis()->get($cacheKey);
        if (empty($list)) {
            $list = $this->getList();
            redis()->set($cacheKey, $list, -1);
        }
        return $list;
    }

    public function deleteCache()
    {
        $cacheKey = 'ADMIN_CONTROLLER_LIST';
        redis()->del($cacheKey);
        return true;
    }

    public function getTextByName($path) 
    {
        $list = $this->getListCache();
        $list = array_column($list, 'name', 'name_en');
        return $list[lcfirst($path)] ?? '';
    }

    /**
     * @method 根据名称获取信息
     * @author Victoria
     * @date   2020-07-15
     * @return array
     */
    public function getInfoByNameEn($name, $isParent = false)
    {
        return $this->baseModel->where('name_en', $name)
                                ->where('parent_id', $isParent ? '=' : '<>', 0)
                                ->find();
    }

    /**
     * @method 检查是否为父类
     * @author LiaoMingRong
     * @date   2020-07-21
     * @return boolean 
     */
    public function isParent($conId)
    {
        $conId = (int) $conId;
        if (empty($conId)) return false;

        return $this->baseModel->where('con_id', $conId)
                               ->where('parent_id', 0)
                               ->count() > 0;
    }

    /**
     * @method 根据父类ID修改信息
     * @author LiaoMingRong
     * @date   2020-07-21
     */
    public function modifyIndoByParentId($parentId, $data)
    {
        $parentId = (int) $parentId;
        if (empty($parentId) || empty($data)) return false;

        return $this->baseModel->where('parent_id', $parentId)
                               ->update($data);
    }

    /**
     * @method 根据父ID删除
     * @author LiaoMingRong
     * @date   2020-07-21
     * @return boolean
     */
    public function deleteByParentId($parentId)
    {
        $parentId = (int) $parentId;
        if (empty($parentId)) return false;

        return $this->baseModel->where('parent_id', $parentId)
                               ->delete();
    }
}