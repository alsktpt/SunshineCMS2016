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
		session(['Sunshineid' => $uid]);
	}


	/**
	 * 用户信息获取函数
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


	public function bladedate()
	{
		return substr(Carbon::today(), 0, 10);
	}

	public function bladetime()
	{
		return substr(Carbon::today(), 11, 5);
	}

}