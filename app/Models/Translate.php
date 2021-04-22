<?php

namespace App\Models;

use App\Models\Base as BaseModel;

/**
 * 	翻译文本 model
 */
class Translate extends BaseModel
{
	//表名
    public $_table = 'translate';
    //主键
    protected $_primaryKey = 'tran_id';

    public function getList($where = [], $page = 1, $size = 20)
    {
        return $this->where($where)->page($page, $size)->get();
    }
}