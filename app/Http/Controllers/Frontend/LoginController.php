<?php

namespace App\Http\Controllers\Frontend;


// 暂时留着
use App\Http\Controllers\Controller;
use App\Foundation\Authentication;

/**
 * Laravel5.1自带ThrottlesLogins（登陆尝试次数限制）
 * 但！
 * ---しかし！
 * 学校的外网访问均转接自校内服务器 ThrottlesLogins无法使用
 * ---学校のインター ネット アクセスが ThrottlesLogins モデル使用できません。
 * 1：无法对IP进行限制    
 * ---ip アドレスを制限できません
 * 2：只对用户名进行限制会伤害无辜群众
 * ---ユーザーを制限するならば、それは普通の人々の感情を傷つけるつもりです。
 * 若有生之年解决服务器转接问题，可以开启ThrottlesLogins选项。
 * ---転送の問題が解決できたら、次のオプションをアクティブにできます。
 * 具体用法请参照Illuminate\Foundation\Auth\AuthenticatesUser
 */

// use Illuminate\Foundation\Auth\ThrottlesLogins;



class LoginController extends Controller
{
    use Authentication;


    // 登陆路由
    protected $loginPath = '/login';
	// Blade模板文件
    protected $loginView = 'frontend.login';
    // 重定向路由
    protected $redirectPath = '/';
	// 用户名字段名称
    protected $username = 'sid';
	// 登出后重定向路由
    // protected $redirectAfterLogout = '/';

}