<?php

namespace App\Services;

use Crypt, Session;

use Carbon\Carbon;

use App\User;
use Illuminate\Http\Request;

class SunshineAuth{


	/**
	 * 用户登出
	 * @param  Request
	 * @return [type]
	 */
	public function logout()
	{
		Session::flush();
	}


	/**
	 * 密码确认函数
	 * 沿袭自Sunshine_Ucenter
	 * @param  postPassword 用户post发送的密码
	 * @param  queryPassword 用户表中取出的加密密码
	 * @param  salt 用户表中取出的盐
	 * @return [bool]
	 */
	public function passwordVerify($postPassword = '', $queryPassword = '', $salt = '')
	{
		return md5(md5($postPassword).$salt) === $queryPassword;
	}
	
	/**
	 * 创建登陆session
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	public function createSession($uid)
	{
		session([
			'Sunshineid' => $uid,
			/* Laravel 原生登陆session 配合Laravel自带的权限控制ACL&Gate/Policy
			（本已修改系统底层，但底层代码在0.4.9版本遗失。
			2018年以后laravel5.1 LTS不再提供安全支持
			此后若欲重构底层，权限与认证可参照Auth/Guard 以及 Access/Gate 等）*/
			'login_'.md5('Illuminate\Auth\Guard') => $uid,
			]);
	}


	/**
	 * 用户信息获取函数   view使用Auth::user 和 SAuth::user 效果相同
	 * 					 Controller中 使用哪个Facade就使用哪个
	 * @author als_ktpt
	 */
	public function user()
	{
		$uid = Session::get('Sunshineid', FALSE);
		if ($uid === FALSE) {
			return FALSE;
		}else{
			$user = User::find($uid);
			return null !== $user
			? $user
			: FALSE;
		}
	}

	public function setRedirect(Request $request)
	{
		session(['sRedir' => $request->path()]);
	}

	/**
	 * [redirectPath description]
	 * @return [type] [description]
	 */
	public function redirectPath()
	{
		return null !== Session::get('sRedir')
		? Session::get('sRedir')
		: FALSE;
	}

	public function forgetRedir()
	{
		Session::forget('sRedir');
	}



}