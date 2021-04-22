<?php

namespace Admin\Controller;
use frame\Html;

class LanguageController extends Controller
{
	public function __construct()
	{
		$this->_arr = [
            'index' => '语言管理',
        ];
		$this->_init();
	}

	public function index() 
	{
		Html::addJs();

		$list = make('App\Services\LanguageService')->getList();

		$this->assign('list', $list);

		return view();
	}

	public function modify()
	{
		$lanId = (int) ipost('lan_id');
		$isDefault = ipost('is_default');
		$status = ipost('status');

		if (empty($lanId)) {
			$this->error('ID不能为空');
		}
		$service = make('App\Services\LanguageService');
		if (!is_null($isDefault)) {
			$isDefault = (int) $isDefault; 
			$isDefault = $isDefault == 1 ? 1 : 0;
			if (!$isDefault) {
				$this->error('参数不正确');
			}
			$result = $service->updateDataById($lanId, ['is_default' => 1]);
			if ($result) {
				$result = $service->where('lan_id', '<>', $lanId)->update(['is_default' => 0]);
			}
			if (!$result) {
				$this->error('设置失败');
			}
		}
		if (!is_null($status)) {
			$status = (int) $status; 
			$status = $status == 1 ? 1 : 0;
			$result = $service->updateDataById($lanId, ['status' => $status]);
			if (!$result) {
				$this->error('设置失败');
			}
		}
		$this->success('设置成功');
	}

	public function update()
	{
		$lanId = (int) ipost('lan_id');
		$isDefault = ipost('is_default');
		$status = ipost('status');
		$name = ipost('name', '');
		$code = ipost('code', '');

		if (empty($name) || empty($code))
			return $this->result(10000, false, ['message' => '参数不正确']);

		$data = [
			'name' => $name,
			'code' => $code,
		];

		if (!is_null($status)) {
			$data['status'] = (int) $status;
		}
		if (!is_null($isDefault)) {
			$data['is_default'] = (int) $isDefault;
		}
		$service = make('App\Services\LanguageService');
		if ($service->existLanguage($code, $lanId)) {
			return $this->error('语言设置重复');
		}

		if (empty($lanId)) {
			$lanId = $service->insertGetId($data);
			$result = $lanId > 0;
		} else {
			$result = $service->updateDataById($lanId, $data);
		}

		if ($result) {
			if (!empty($isDefault)) {
				$service->where('lan_id', '<>', $lanId)->update(['is_default'=>0]);
			}
			$service->clearCache();
			return $this->success('保存成功');
		} else {
			return $this->error('保存失败');
		}

	}
}