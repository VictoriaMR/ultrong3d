<?php

namespace App\Models\Admin;

use App\Models\Base as BaseModel;

class Controller extends BaseModel
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 0;
    const EXPIRE_TIME = 60 * 60 * 24;
    
    //表名
    public $_table = 'admin_controller';
    //主键
    protected $_primaryKey = 'con_id';

}