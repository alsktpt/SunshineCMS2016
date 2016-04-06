<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * 	旧用户中心的兼容模型
 */
class Studentlist extends Model
{
	/**
	* 连接到ucenter
	*
	* @var string
	*/
	protected $connection = 'olducenter';

	/**
	* 不使用timestamps
	*
	* @var bool
	*/
	public $timestamps = false;

	/**
	* 主键为学号
	*
	* @var string
	*/
	protected $primaryKey = 'sid';

	/**
	 * 表名为sun_student_list
	 *
	 * @var  string [<description>]
	 */
	protected $table='sun_student_list';

	/**
	 *  禁止增加数据
	 */
	protected $fillable=[];

	public function user()
	{
	    return $this->belongsTo('App\Oldmember', 'sid', 'sid');
	}

}	
