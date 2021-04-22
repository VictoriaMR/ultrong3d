<?php

namespace Admin\Controller;
use App\Services\TranslateService;
use frame\Html;

class TransferController extends Controller
{
	function __construct(TranslateService $service)
	{
		$this->baseService = $service;
		$this->_arr = [
            'index' => '翻译列表',
        ];
		$this->_init();
	}

	public function index()
	{
		Html::addJs();

		$page = (int) iget('page', 1);
		$size = (int) iget('size', 20);
		$type = iget('type', '');
		$filter = iget('filter', 0);
		$keyword = iget('keyword', '');

		$where = [];
		if (!empty($type)) 
			$where['type'] = $type;

		if (!empty($filter)) 
			$where['value'] = [$filter == 1 ? '=' : '<>' , ''];
		
		if (!empty($keyword))
			$where['name'] = ['like' , '%'.$keyword.'%'];

		$total = $this->baseService->getListTotal($where);
		if ($total > 0) {
			$list = $this->baseService->getList($where, $page, $size);
		}

		$this->assign('list', $list ?? []);
		$this->assign('total', $total);
		$this->assign('size', $size);
		return view();
	}

	public function modify()
	{
		$tranId = (int) ipost('tran_id', 0);
		$name = ipost('name', '');		
		$value = ipost('value', '');
		$type = ipost('type', '');

		if (empty($tranId) || empty($value))
			return $this->result(10000, false, ['message' => '参数不正确']);

		$result = $this->baseService->updateDataById($tranId, ['value'=>$value]);
		if ($result) {
			$this->baseService->updateCache($name, $type, $name);
			return $this->result(200, $result, ['message' => '保存成功']);
		} else {
			return $this->result(10000, $result, ['message' => '保存失败']);
		}
	}

	/**
	 * @method 重构翻译缓存
	 * @author LiaoMingRong
	 * @date   2020-07-22
	 */
	public function reloadCache()
	{
		$result = $this->baseService->reloadCache();

		if ($result)
			return $this->success('重构成功');
		else
			return $this->error('重构失败');
	}
}