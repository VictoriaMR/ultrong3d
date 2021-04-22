<?php

namespace Admin\Controller;
use frame\Html;
use frame\Session;

/**
 * 
 */
class IndexController extends Controller
{
	public function index() 
	{
		Html::addCss();
		Html::addJs();

		//获取控制器列表
		$controllerService = \App::make('App\Services\Admin\ControllerService');
		$controllerList = $controllerService->getListFormat();

		//网站信息
		$siteService = \App::make('App/Services/SiteService');
		$siteInfo = $siteService->getInfo();

		//基本信息
		$info = Session::get('admin');

		$this->assign('site_info', $siteInfo);
		$this->assign('info', $info);
		$this->assign('controllerList', $controllerList);
		$this->assign('title', (!empty($siteInfo['name']) ? $siteInfo['name'].'-' : '') . '管理后台');

		return view();
	}
}