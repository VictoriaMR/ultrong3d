<?php

namespace Admin\Controller;
use App\Services\Admin\MemberService;
use frame\Html;
use frame\Session;

/**
 *  个人中心信息栏
 */
class ProfileController extends Controller
{
	public function __construct(MemberService $service)
	{
		$this->baseService = $service;
		$this->_arr = [
            'index' => '个人信息',
            'modifyPassword' => '修改密码',
        ];
		$this->_init();
	}

	public function index()
	{	
		$userId = Session::get('admin_mem_id');
		$info = $this->baseService->loadData($userId);
		$info = array_merge($info, Session::get('admin'));

		$this->assign('info', $info);

		return view();
	}

	/**
	 * @method 更新头像
	 * @author LiaoMingRong
	 * @date   2020-07-21
	 */
	public function updateAvatar()
	{
		$attachId = (int)ipost('attach_id', 0);
		if (empty($attachId)) {
			return $this->result(10000, false, ['message' => '文件ID缺失']);
		}

		$attachmentService = make('App\Services\AttachmentService');
		$info = make('App\Services\AttachmentService')->getAttachmentById($attachId);

		if (empty($info)) {
			return $this->result(10000, false, ['message' => '文件不存在']);
		}
		$userId = Session::get('admin_mem_id');
		$result = $this->baseService->updateDataById($userId, ['avatar' => $info['cate'].'/'.$info['name'].'.'.$info['type']]);
		if ($result) {
			Session::set('admin_avatar', $info['url']);
			return $this->success('更新成功');
		} else {
			return $this->error('更新失败');
		}
	}

	public function modifyPassword()
	{
		Html::addJs();
		return view();
	}

	public function updatePassword()
	{
		$password = ipost('password', '');
		$repassword = ipost('repassword', '');

		if (empty($password) || empty($repassword))
			return $this->result(10000, false, ['message' => '密码输入不正确']);

		if ($password != $repassword)
			return $this->result(10000, false, ['message' => '两次输入密码不正确']);

		$password = $this->baseService->getPasswd($password, Session::get('admin_salt'));

		$password = password_hash($password, PASSWORD_DEFAULT);

		$result = $this->baseService->updateDataById(Session::get('admin_mem_id'), ['password' => $password]);

		if ($result) {
			return $this->result(200, true, ['message' => '修改成功']);
		} else {
			return $this->result(10000, false, ['message' => '修改失败']);
		}
	}
}