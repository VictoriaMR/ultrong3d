<?php

namespace App\Models;
use App\Models\Base as BaseModel;

class Language extends BaseModel
{
	//表名
    public $_table = 'language';
    //主键
    protected $_primaryKey = 'lan_id';
}