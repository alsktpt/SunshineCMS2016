<?php 

/**
* @author  Als_ktpt <[<ktpt@me.com>|<ktpt@qq.com>]>
*/
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SAuth extends Facade
{
	
	protected static function getFacadeAccessor()
	{
		return 'SAuth';
	}
}