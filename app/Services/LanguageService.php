<?php

namespace App\Services;

use App\Services\Base as BaseService;
use App\Models\Language;

class LanguageService extends BaseService
{
	public function __construct(Language $model)
    {
        $this->baseModel = $model;
    }

    /**
     * @method 获取语言列表
     * @author LiaoMingRong
     * @date   2020-07-13
     * @param  [type]     $data [description]
     * @return array
     */
    public function getListCache($where = [])
    {
    	$cacheKey = 'LANGUAGE_LIST_ON_CACHE';
    	$list = Redis()->get($cacheKey);
    	if (empty($list)) {
    		$list = $this->baseModel->where('status', 1)->get();
    		Redis()->set($cacheKey, $list, -1);
    	}

    	return $list;
    }

    public function getList($where = [])
    {
        return $this->baseModel->get();
    }

    public function clearCache()
    {
        $cacheKey = 'LANGUAGE_LIST_ON_CACHE';
        Redis()->del($cacheKey);

        $cacheKey = 'LANGUAGE_LIST_ALL_CACHE';
        Redis()->del($cacheKey);

        return true;
    }

    public function existLanguage($code, $lanId = 0)
    {
        if (empty($code)) return false;

        $query = $this->baseModel->where('code', $code);
        if (!empty($lanId)){
            $query->where('lan_id', '<>', (int) $lanId);
        }
        return $query->count() > 0;
    }
}