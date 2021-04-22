<?php

namespace App\Models;
use App\Models\Base as BaseModel;

class Site extends BaseModel
{
	//表名
    public $_table = 'site';
    //主键
    protected $_primaryKey = 'site_id';
}